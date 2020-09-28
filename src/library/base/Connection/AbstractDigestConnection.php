<?php


namespace iikoExchangeBundle\Library\base\Connection;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use iikoExchangeBundle\Contract\Auth\TokenAuthDataInterface;
use iikoExchangeBundle\Contract\AuthDataInterface;
use iikoExchangeBundle\Contract\Connection\ConnectionInfoInterface;
use iikoExchangeBundle\Contract\Connection\DigestConnectionInfoInterface;
use iikoExchangeBundle\Contract\ConnectionInterface;
use iikoExchangeBundle\Contract\DataRequestInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractDigestConnection extends AbstractConnection
{
	const TOKEN_TYPE_QUERY = 'token_in_query';
	const TOKEN_TYPE_HEADER = 'token_in_header';

	protected $tokenName = 'key';
	protected $tokenType = self::TOKEN_TYPE_QUERY;
	/** @var DigestConnectionInfoInterface */
	protected $connectionInfo;
	/** @var TokenAuthDataInterface */
	protected $authData;

	public function getClient(): ClientInterface
	{
		return (new Client(
			[
				'base_uri' => $this->connectionInfo->getHost(),
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

	abstract protected function login();


	protected function pushResponseHandler(HandlerStack $handlerStack)
	{

	}

	protected function pushAddAuthDataHandler(HandlerStack $handlerStack)
	{
		if (empty($this->getAuthData()) || $this->getAuthData()->getToken() === null)
		{
			$this->login();
		}

		$handlerStack->push(Middleware::mapRequest(function (RequestInterface $request)
		{
			if ($this->tokenType === self::TOKEN_TYPE_QUERY)
			{
				$request = $request->withUri(Uri::withQueryValue($request->getUri(), $this->tokenName, $this->getAuthData()->getToken()));
			}
			if ($this->tokenType === self::TOKEN_TYPE_HEADER)
			{
				$request = $request->withHeader($this->tokenName, $this->getAuthData()->getToken());
			}
			return $request;

		}));
	}
}