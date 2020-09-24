<?php


namespace iikoExchangeBundle\Library\base\Connection;


use iikoExchangeBundle\Contract\AuthStorageInterface;
use iikoExchangeBundle\Contract\ConnectionInterface;
use iikoExchangeBundle\Contract\ProviderInterface;
use Psr\Log\LoggerInterface;

abstract class AbstractProvider implements ProviderInterface
{
	/** @var LoggerInterface */
	protected $logger;
	/** @var AuthStorageInterface */
	protected $authStorage;

	/** @var ConnectionInterface */
	protected $connection;

	public function withConnection(ConnectionInterface $connection): ProviderInterface
	{
		$new = clone $this;
		$connection->setAuthStorage($this->authStorage)->setLogger($this->logger);
		$new->connection = $connection;

		return $new;
	}

	public function getConnection(): ConnectionInterface
	{
		return $this->connection;
	}
}