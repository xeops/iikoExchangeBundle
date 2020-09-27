<?php


namespace iikoExchangeBundle\Library\base\Connection;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use iikoExchangeBundle\Contract\Auth\DigestAuthDataInterface;
use iikoExchangeBundle\Contract\AuthDataInterface;
use iikoExchangeBundle\Contract\DataRequestInterface;
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

	public function sendRequest(DataRequestInterface $request): ResponseInterface
	{
		return $this->getClient()->send($request->getRequest());
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
			$this->logger->info("EXCHANGE_REQUEST_SEND", [
				'method' => $request->getMethod(),
				'url' => $request->getUri()->__toString(),
				'content' => $request->getBody(),
				'headers' => $request->getHeaders(),
			]);

			return $request;
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

	abstract protected function login();


	protected function pushResponseHandler(HandlerStack $handlerStack)
	{
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

	protected function pushAddAuthDataHandler(HandlerStack $handlerStack)
	{
		if (empty($this->getAuthData()) || $this->getAuthData()->getToken() === null)
		{
			$this->login();
		}

		$handlerStack->push(Middleware::mapRequest(function (RequestInterface $request)
		{
			if ($this->getAuthData()->getTokenType() === DigestAuthDataInterface::TOKEN_TYPE_QUERY)
			{
				$request = $request->withUri(Uri::withQueryValue($request->getUri(), $this->getAuthData()->getTokenName(), $this->getAuthData()->getToken()));
			}
			if ($this->getAuthData()->getTokenType() === DigestAuthDataInterface::TOKEN_TYPE_HEADER)
			{
				$request = $request->withHeader($this->getAuthData()->getTokenName(), $this->getAuthData()->getToken());
			}
			return $request;

		}));
	}
}