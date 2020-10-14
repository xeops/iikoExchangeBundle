<?php


namespace iikoExchangeBundle\Contract;


use iikoExchangeBundle\Contract\Connection\ConnectionInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use Psr\Log\LoggerInterface;

interface ProviderInterface extends \JsonSerializable
{
	public function getCode() : string;

	public function sendRequest(DataRequestInterface $request);

	public function withConnection(ConnectionInterface $connection, bool $immutable = true) : self;

	public function getConnection() : ConnectionInterface;

	public function setLogger(LoggerInterface $logger);

	public function setAuthStorage(AuthStorageInterface $authStorage);
}