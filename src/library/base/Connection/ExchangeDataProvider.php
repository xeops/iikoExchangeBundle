<?php


namespace iikoExchangeBundle\Library\base\Connection;


use iikoExchangeBundle\Contract\AuthStorageInterface;
use iikoExchangeBundle\Contract\Connection\ConnectionInterface;

use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Contract\ProviderInterface;
use Psr\Log\LoggerInterface;

class ExchangeDataProvider implements ProviderInterface
{
	protected string $code;

	public function __construct(string $code)
	{
		$this->code = $code;
	}

	/** @var LoggerInterface */
	protected $logger;
	/** @var AuthStorageInterface */
	protected $authStorage;

	/** @var ConnectionInterface */
	protected $connection;

	public function withConnection(ConnectionInterface $connection, bool $immutable = true): ProviderInterface
	{
		$new = $immutable ? clone $this : $this;

		$connection->setAuthStorage($this->authStorage)->setLogger($this->logger);
		$new->connection = $connection;

		return $new;
	}

	public function getConnection(): ConnectionInterface
	{
		return $this->connection;
	}

	public function sendRequest(DataRequestInterface $request)
	{
		$response = $this->connection->sendRequest($request);
		if ($response->getStatusCode() === 200)
		{
			return $request->processResponse($response->getBody()->__toString());
		}
		else
		{
			// no need log, because connection must do that
			return $request->processError($response);
		}
	}

	/**
	 * @param LoggerInterface $logger
	 */
	public function setLogger(LoggerInterface $logger): void
	{
		$this->logger = $logger;
	}

	/**
	 * @param AuthStorageInterface $authStorage
	 */
	public function setAuthStorage(AuthStorageInterface $authStorage): void
	{
		$this->authStorage = $authStorage;
	}

	public function jsonSerialize()
	{
		return [
			self::FIELD_CODE => $this->getCode(),
			self::FIELD_CONNECTION => $this->getConnection()
		];
	}


	public function getCode(): string
	{
		return $this->code;
	}
}