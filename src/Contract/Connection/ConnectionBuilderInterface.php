<?php


namespace iikoExchangeBundle\Contract\Connection;


use iikoExchangeBundle\Contract\AuthStorageInterface;
use iikoExchangeBundle\Contract\Connection\ConnectionInterface;
use Psr\Log\LoggerInterface;

interface ConnectionBuilderInterface
{
	public function setAuthStorage(AuthStorageInterface $authStorage) : ConnectionInterface;

	public function setLogger(LoggerInterface $logger) : ConnectionInterface;
}