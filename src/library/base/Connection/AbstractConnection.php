<?php


namespace iikoExchangeBundle\Library\base\Connection;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use iikoExchangeBundle\Contract\AuthStorageInterface;
use iikoExchangeBundle\Contract\ConnectionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class AbstractConnection implements ConnectionInterface
{
	/** @var LoggerInterface */
	protected $logger;
	/** @var AuthStorageInterface|null */
	protected $authStorage;

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
}