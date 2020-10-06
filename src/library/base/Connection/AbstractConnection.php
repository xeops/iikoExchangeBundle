<?php


namespace iikoExchangeBundle\Library\base\Connection;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\RequestOptions;
use iikoExchangeBundle\Contract\AuthDataInterface;
use iikoExchangeBundle\Contract\AuthStorageInterface;
use iikoExchangeBundle\Contract\Connection\ConnectionBuilderInterface;
use iikoExchangeBundle\Contract\Connection\ConnectionInfoInterface;
use iikoExchangeBundle\Contract\ConnectionInterface;
use iikoExchangeBundle\Contract\DataRequestInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class AbstractConnection implements ConnectionInterface, ConnectionBuilderInterface
{
	/** @var LoggerInterface */
	protected $logger;
	/** @var AuthStorageInterface|null */
	protected $authStorage;
	/** @var ConnectionInfoInterface */
	protected $connectionInfo;
	/** @var AuthDataInterface */
	protected $authData;

	public function withConnectionInfo(ConnectionInfoInterface $connectionInfo, bool $immutable = true): ConnectionInterface
	{
		$new = $immutable ? clone $this : $this;
		$new->connectionInfo = $connectionInfo;
		$new->authData = null;

		return $new;
	}

	abstract protected function transformAuthData(string $data): ?AuthDataInterface;

	abstract protected function login();

	protected function getAuthData(): ?AuthDataInterface
	{
		return $this->authData ?? ($this->authData = $this->transformAuthData($this->authStorage->getAuthData($this->connectionInfo)));
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

	protected function pushResponseHandler(HandlerStack $handlerStack)
	{

		$handlerStack->push(Middleware::mapResponse(function (ResponseInterface $response)
		{
			return $response;
		}));
	}

	abstract protected function pushAddAuthDataHandler(HandlerStack $handlerStack);
}