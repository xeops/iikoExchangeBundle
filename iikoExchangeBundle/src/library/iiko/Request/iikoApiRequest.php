<?php

namespace IikoApiBundle\Request;

use AppBundle\Utils\StringHelper;
use AppBundle\Utils\UniqueLogProcessor;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use function GuzzleHttp\Psr7\build_query;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use IikoApiBundle\Exceptions\ConflictException;
use IikoApiBundle\Exceptions\IikoApiKeyException;
use IikoApiBundle\Exceptions\NotFoundException;
use IikoApiBundle\Exceptions\RmsServerException;
use IikoApiBundle\Exceptions\ServerErrorException;
use IikoApiBundle\Exceptions\TokenExpireException;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class iikoApiRequest
 * Выполняет запрос к апи айко
 * Возвращает ответ от сервера в случае успеха
 * Если апи сервера вернуло ошибку - сохраняет об этом информацию в соответствующих полях
 *
 * @package IikoApiBundle\Request
 */
class iikoApiRequest
{
	protected $type = 'get';
	protected $prefix = "/resto/api/";
	/** @var  LoggerInterface $logger */
	protected $logger;
	protected $protocol;
	protected $server;
	protected $port;
	protected $key;
	protected $timeOut = 30;
	protected $timeZone;
	protected $lang = 'en';
	protected $rmsVersion = '5.4';
	/** @var UniqueLogProcessor */
	protected $uniqueLogProcessor;
	protected $enableClientType = true;

	/**
	 * @return mixed
	 */
	public function getTimeZone()
	{
		if (!$this->timeZone)
		{
			$this->timeZone = new \DateTimeZone(date_default_timezone_get());
		}
		return $this->timeZone;
	}

	/**
	 * @param mixed $timeZone
	 */
	public function setTimeZone($timeZone)
	{
		$this->timeZone = $timeZone;
	}


	/**
	 * Три поля ниже были добавлены для проброса информации об ответе от сервера
	 * Весь остальной функционал работы с апи писался без них (их тогда еще не было добавлено)
	 */
	/** @var int Код ответа сервера */
	private $responseCode;
	/** @var string Сообщение об ошибке */
	private $errorMessage;
	/** @var bool Успешен ли запрос */
	private $success = false;

	/**
	 * @return int
	 */
	public function getResponseCode()
	{
		return $this->responseCode;
	}

	/**
	 * @param int $responseCode
	 * @return iikoApiRequest
	 */
	public function setResponseCode($responseCode)
	{
		$this->responseCode = $responseCode;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getErrorMessage()
	{
		return $this->errorMessage;
	}

	/**
	 * @param string $errorMessage
	 * @return iikoApiRequest
	 */
	public function setErrorMessage($errorMessage)
	{
		$this->errorMessage = $errorMessage;

		return $this;
	}

	/**
	 * @return bool
	 */
	public function isSuccess()
	{
		return $this->success;
	}

	/**
	 * @param bool $success
	 * @return iikoApiRequest
	 */
	public function setSuccess($success)
	{
		$this->success = $success;

		return $this;
	}

	/**
	 * setServer function.
	 *
	 * @access public
	 * @param mixed $server
	 * @param mixed $port
	 * @param string $protocol
	 */
	public function setServer($server, $port, $protocol = 'http')
	{
		$this->protocol = $protocol;
		$this->server = $server;
		$this->port = $port;
	}

	/**
	 * setKey function.
	 *
	 * @access public
	 * @param mixed $key
	 * @return void
	 */
	public function setKey($key)
	{
		$this->key = $key;
	}

	/**
	 * @return mixed
	 */
	public function getKey()
	{
		return $this->key;
	}

	/**
	 * @param LoggerInterface $logger
	 */
	public function setLogger(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	/**
	 * Выполняет запрос к апи айко
	 * Возвращает ответ от сервера в случае успеха
	 * Если апи сервера вернуло ошибку - сохраняет об этом информацию в соответствующих полях
	 *
	 * @param bool $f используется для дебага запросов
	 * @return mixed
	 * @throws \Exception
	 */
	public function fire($f = false)
	{
		$requestURL = $this->protocol . '://' . $this->server . ":" . $this->port . $this->prefix . $this->requestURL();

		if ($this->requestFullURL())
		{
			$requestURL = $this->requestFullURL();
		}

		$headers = $this->requestHeaders();
		$requestParams = $this->requestParams();
		$params = $requestParams ? $requestParams : ((strtolower($this->type) != 'get') ? '' : $requestParams);
		if ($this->uniqueLogProcessor)
		{
			$headers['X-Resto-CorrelationId'] = $this->uniqueLogProcessor->getPid();
		}
		if ($f)
		{
			var_dump($this->type, $requestURL, $headers, $params);
			echo $params;
			die;
		}
		$response = null;
		$options = [];
		$options['timeout'] = $this->timeOut;
		if (isset($this->logger))
		{
			$this->logger->info('Sending api request to iiko',
				[
					'url' => $requestURL,
					'headers' => $headers,
					'options' => $options,
					'params' => $params,
					'type' => $this->type,
					'rmsVersion' => $this->rmsVersion,
					'lang' => $this->lang
				]);
		}
		$client = new Client();
		$uri = new Uri($requestURL);
		$body = null;
		if ($this->type == 'get')
		{
			if (!isset($params['key']))
			{
				$params['key'] = $this->key;
			}
			// build_query не умеет в boolean
			array_walk_recursive($params, function (&$value)
			{
				if (is_bool($value))
				{
					$value = $value ? "true" : "false";
				}
			});
			if ($this->enableClientType === true)
			{
				$params['client-type'] = 'iikoweb';
			}

			$uri = $uri->withQuery(build_query($params));
		}
		else
		{
			if (isset($headers['Content-Type']))
			{
				switch ($headers['Content-Type'])
				{
					case "application/x-www-form-urlencoded":
						if (is_array($params))
						{
							$body = StringHelper::encodeFormParamsToJavaApi($params);
						}
						break;
					default:
						$body = $params;
						break;
				}
			}
			else
			{
				$body = $params ? $params : '';
			}
		}
		$guzzleRequest = new Request($this->type, $uri, $headers, $body);
		try
		{
			$response = $client->send($guzzleRequest, $options);
			$this->setResponseCode($response->getStatusCode());
			$this->checkResponse($response->getStatusCode(), $response);
			$contents = $response->getBody()->__toString();
			$this->setSuccess(true);
			return $this->processResponse($contents);
		} catch (RequestException $e)
		{
			$this->checkResponse($e->getCode(), $e->getResponse(), $e->getMessage());
			return false;
		}

	}

	/**
	 * @param $httpCode
	 * @param null $contents
	 * @param string $errorMessage
	 * @throws ConflictException
	 * @throws NotFoundException
	 * @throws ServerErrorException
	 * @throws TokenExpireException
	 */
	private function checkResponse($httpCode, ?ResponseInterface $response = null, $errorMessage = '')
	{
		if (in_array($httpCode, [200, 201, 202, 203, 204]))
		{
			return;
		}
		$contents = !$response ? '' : (!$response->getBody() ? '' : $response->getBody()->__toString());
		if ($httpCode === 0)
		{
			if (strpos($errorMessage, 'cURL error 6: Could not resolve host:') === 0)
			{
				throw new IikoApiKeyException(504, $contents, $errorMessage, $this);
			}
		}
		if ($httpCode >= 500)
		{
			if ($this->logger)
			{
				$this->logger->warning(__METHOD__, ['code' => $httpCode, 'contents' => $contents, 'message' => $errorMessage]);
			}
			$this->setErrorMessage($httpCode . ' error: ' . $errorMessage);
			throw new ServerErrorException($httpCode, $contents, $errorMessage, $this);
		}
		switch ($httpCode)
		{
			case 404:
				if ($this->logger)
				{
					$this->logger->warning(__METHOD__, ['code' => $httpCode, 'contents' => $contents, 'message' => $errorMessage]);
				}
				$this->setErrorMessage('404 error: ' . $errorMessage);
				throw new NotFoundException($httpCode, $contents, $errorMessage, $this);
				break;
			case 401:
				if ($this->logger)
				{
					$this->logger->warning(__METHOD__, ['describe' => 'Token expired', 'contents' => $contents, 'code' => $httpCode, 'message' => $errorMessage]);
				}
				$this->setErrorMessage('Token expired');
				throw new TokenExpireException($httpCode, $contents, $errorMessage, $this);
				break;
			case 409:
				if ($this->logger)
				{
					$this->logger->warning(__METHOD__, ['code' => $httpCode, 'contents' => $contents, 'message' => $errorMessage]);
				}
				$this->setErrorMessage('409 error: ' . $response->getBody());
				throw new ConflictException($httpCode, $contents, $errorMessage, $this);
				break;
			case 403:
				if ($this->logger)
				{
					$this->logger->warning(__METHOD__, ['describe' => 'permission denied', 'contents' => $contents, 'code' => $httpCode, 'message' => $errorMessage]);
				}
				$this->setErrorMessage('Permission denied');
				throw new TokenExpireException($httpCode, $contents, $errorMessage, $this);
				break;
			default:
				$this->setErrorMessage('Request error: ' . $httpCode . ' ' . $errorMessage);
				throw new RmsServerException($httpCode, $contents, $errorMessage, $this);
				break;
		}
	}

	/**
	 * requestURL function.
	 *
	 * @access public
	 * @return string
	 */
	protected function requestURL()
	{
		return '';
	}

	/**
	 * requestHeaders function.
	 *
	 * @access public
	 * @return array
	 */
	protected function requestHeaders()
	{
		return ["Accept" => "application/xml", "Accept-Language" => $this->getLang(),
			'Content-Type' => "application/xml", 'Accept-Encoding' => "gzip"];
	}


	/**
	 * requestParams function.
	 *
	 * @access public
	 * @return array
	 */
	protected function requestParams()
	{
		return [];
	}

	protected function requestFullURL()
	{
		return null;
	}

	/**
	 * processResponse function.
	 *
	 * @access protected
	 * @param mixed $response
	 * @return mixed
	 */
	protected function processResponse($response)
	{
		return $response;
	}

	/**
	 * @return string
	 */
	public function getLang(): string
	{
		return !$this->lang ? 'en' : $this->lang;
	}

	/**
	 * @param string $lang
	 * @return $this
	 */
	public function setLang(string $lang)
	{
		$this->lang = $lang;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getTimeOut()
	{
		return $this->timeOut;
	}

	/**
	 * @param int $timeOut
	 * @return iikoApiRequest
	 */
	public function setTimeOut($timeOut): iikoApiRequest
	{
		$this->timeOut = $timeOut;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getRmsVersion(): string
	{
		return $this->rmsVersion;
	}

	/**
	 * @param string $rmsVersion
	 * @return iikoApiRequest
	 */
	public function setRmsVersion(string $rmsVersion): iikoApiRequest
	{
		$this->rmsVersion = $rmsVersion;
		return $this;
	}

	/**
	 * @param UniqueLogProcessor $uniqueLogProcessor
	 * @return iikoApiRequest
	 */
	public function setUniqueLogProcessor(UniqueLogProcessor $uniqueLogProcessor)
	{
		$this->uniqueLogProcessor = $uniqueLogProcessor;
		return $this;
	}

}
