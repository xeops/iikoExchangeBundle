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

	public function withConnectionInfo(ConnectionInfoInterface $connectionInfo, bool $immutable = true) : ConnectionInterface
	{
		$new = $immutable ? clone $this : $this;
		$new->connectionInfo = $connectionInfo;
		$new->authData = null;

		return $new;
	}
	abstract protected function transformAuthData(string $data) : ?AuthDataInterface;

	protected function getAuthData() : ?AuthDataInterface
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
}