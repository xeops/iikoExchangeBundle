<?php


namespace iikoExchangeBundle\Contract;


use iikoExchangeBundle\Contract\Connection\ConnectionInfoInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ConnectionInterface
{
	public function getConnectionConfig() : ConnectionInfoInterface;

	public function withConnectionInfo(ConnectionInfoInterface $authData, bool $immutable = true) : ConnectionInterface;

	public function sendRequest(DataRequestInterface $request): ResponseInterface;
}