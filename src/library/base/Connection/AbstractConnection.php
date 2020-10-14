<?php


namespace iikoExchangeBundle\Library\base\Connection;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\RequestOptions;
use iikoExchangeBundle\Contract\AuthStorageInterface;
use iikoExchangeBundle\Contract\Connection\ConnectionBuilderInterface;
use iikoExchangeBundle\Contract\Connection\ConnectionInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Library\base\Config\Types\StringConfigItem;
use iikoExchangeBundle\Library\Traits\ConfigurableTrait;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class AbstractConnection implements ConnectionInterface, ConnectionBuilderInterface, \JsonSerializable
{
	use ConfigurableTrait;

	/** @var LoggerInterface */
	protected LoggerInterface $logger;

	/** @var AuthStorageInterface|null */
	protected AuthStorageInterface $authStorage;

	abstract protected function login();


	protected function getAuthData()
	{
		$this->authStorage->getAuthData($this->getLoginInfoUnique());
	}

	protected function createConfig()
	{
		return [
			'host' => new StringConfigItem()
		];
	}

	protected function getLoginInfoUnique() : string
	{
		return md5(json_encode($this->getConfiguration()));
	}

	public function setLogger(LoggerInterface $logger): ConnectionInterface
	{
		$this->logger = $logger;
		return $this;
	}

	public function setAuthStorage(AuthStorageInterface $authStorage): ConnectionInterface
	{
		$this->authStorage = $authStorage;
		return $this;
	}

	public function sendRequest(DataRequestInterface $request): ResponseInterface
	{
		return $this->getClient()->send($request->getRequest(), [RequestOptions::TIMEOUT => $request->getTimeOut()]);
	}

	public function getClient(): ClientInterface
	{
		return (new Client(
			[
				'base_uri' => $this->getConfiguration()['host']->getValue(),
				'handler' => $this->getHandlers(),
				'http_errors' => false
			]
		));
	}

	protected function getHandlers(): HandlerStack
	{
		$handlers = HandlerStack::create();

		$this->pushAddAuthDataHandler($handlers);
		$this->pushLoggerHandler($handlers);
		$this->pushResponseHandler($handlers);
		$this->pushRetryHandler($handlers);

		return $handlers;
	}

	protected function pushLoggerHandler(HandlerStack $handlerStack)
	{
		$handlerStack->push(Middleware::mapRequest(function (RequestInterface $request) use (&$key)
		{
			$this->logger->info("EXCHANGE_REQUEST_SEND", [
				'method' => $request->getMethod(),
				'url' => $request->getUri()->__toString(),
				'content' => $request->getBody(),
				'headers' => $request->getHeaders(),
			]);

			return $request;
		}));


		$handlerStack->push(Middleware::mapResponse(function (ResponseInterface $response)
		{
			if ($response->getStatusCode() < 300)
			{
				$this->logger->info("EXCHANGE_RESPONSE_SUCCESS", ['code' => $response->getStatusCode()]);
				$this->logger->debug("EXCHANGE_RESPONSE_SUCCESS", ['response' => $response->getBody()->getContents()]);
			}
			else
			{
				$this->logger->error("EXCHANGE_RESPONSE_ERROR", ['code' => $response->getStatusCode(), 'body' => $response->getBody()->getContents(), 'reason' => $response->getReasonPhrase()]);
			}
			return $response;
		}));
	}

	protected function pushRetryHandler(HandlerStack $handlerStack)
	{
		$handlerStack->push(Middleware::retry(function ($retries, RequestInterface $request, ?ResponseInterface $response = null, ?\Exception $exception = null)
		{
			if ($retries === 0 && $response && $response->getStatusCode() === 401)
			{
				$this->logger->warning("EXCHANGE_RESPONSE_ERROR", ['step' => '401 unauthorized', 'retries' => $retries, 'response' => $response->getReasonPhrase(), 'body' => $response->getBody()]);
				$this->login();
				return true;
			}
			return false;
		}));
	}

	protected function pushResponseHandler(HandlerStack $handlerStack)
	{

		$handlerStack->push(Middleware::mapResponse(function (ResponseInterface $response)
		{
			return $response;
		}));
	}

	abstract protected function pushAddAuthDataHandler(HandlerStack $handlerStack);


	public function jsonSerialize()
	{
		return [
			'config' => $this->getConfiguration()
		];
	}
}