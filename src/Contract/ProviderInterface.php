<?php


namespace iikoExchangeBundle\Contract;


use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use Psr\Log\LoggerInterface;

interface ProviderInterface
{
	public function sendRequest(DataRequestInterface $request);

	public function withConnection(ConnectionInterface $connection, bool $immutable = true) : self;

	public function getConnection() : ConnectionInterface;

	public function setLogger(LoggerInterface $logger);

	public function setAuthStorage(AuthStorageInterface $authStorage);
}