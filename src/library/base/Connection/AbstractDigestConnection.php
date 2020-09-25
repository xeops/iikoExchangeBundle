<?php


namespace iikoExchangeBundle\Library\base\Connection;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use iikoExchangeBundle\Contract\Auth\DigestAuthDataInterface;
use iikoExchangeBundle\Contract\AuthDataInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractDigestConnection extends AbstractConnection
{
	/**
	 * @var DigestAuthDataInterface
	 */
	protected $authData;

	public function setAuthData(?AuthDataInterface $authData)
	{
		if (empty($authData))
		{
			throw new \Exception('');
		}
		if (!($authData instanceof DigestAuthDataInterface))
		{
			throw new \Exception('');
		}

		$this->authStorage->storeAuthData($authData);
	}

	/**
	 * @return DigestAuthDataInterface|null
	 */
	public function getAuthData(): ?AuthDataInterface
	{
		if (!$this->authData)
		{
			$this->authData = $this->authStorage->getAuthData();
		}
		return $this->authData;
	}

	public function sendRequest(RequestInterface $request): ResponseInterface
	{
		return $this->getClient()->send($request);
	}

	public function getClient(): ClientInterface
	{
		return (new Client(
			[
				'base_uri' => $this->getAuthData()->getUrl(),
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
			$this->logger->info("EXCHANGE_SEND_REQUEST", [
				'url' => $request->getUri()->__toString(),
				'content' => $request->getBody(),
				'headers' => $request->getHeaders()
			]);
		}));
	}

	protected function pushRetryHandler(HandlerStack $handlerStack)
	{
		$handlerStack->push(Middleware::retry(function ($retries, RequestInterface $request, ResponseInterface $response, \Exception $exception)
		{
			if ($retries === 0 && $response && $response->getStatusCode() === 401)
			{
				$this->logger->warning("EXCHANGE_SEND_ERROR", ['step' => '401 unauthorized', 'retries' => $retries, 'response' => $response->getReasonPhrase(), 'body' => $response->getBody()]);
				$this->login();
				return true;
			}
			return false;
		}));
	}

	abstract protected function login();


	protected function pushResponseHandler(HandlerStack $handlerStack)
	{

	}

	protected function pushAddAuthDataHandler(HandlerStack $handlerStack)
	{
		if(empty($this->getAuthData()) || $this->getAuthData()->getValue() === null)
		{
			$this->login();
		}

		$handlerStack->push(Middleware::mapRequest(function (RequestInterface $request)
		{
			if ($this->getAuthData()->getType() === DigestAuthDataInterface::TYPE_QUERY_KEY)
			{
				$request = $request->withUri(Uri::withQueryValue($request->getUri(), $this->getAuthData()->getKey(), $this->getAuthData()->getValue()));
			}
			if ($this->getAuthData()->getType() === DigestAuthDataInterface::TYPE_HEADER_KEY)
			{
				$request = $request->withHeader($this->getAuthData()->getKey(), $this->getAuthData()->getValue());
			}
			return $request;

		}));
	}
}