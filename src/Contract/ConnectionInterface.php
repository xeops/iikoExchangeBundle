<?php


namespace iikoExchangeBundle\Contract;


use iikoExchangeBundle\Contract\Connection\ConnectionInfoInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

interface ConnectionInterface
{
	public function withConnectionInfo(ConnectionInfoInterface $authData, bool $immutable = true) : ConnectionInterface;

	public function sendRequest(DataRequestInterface $request): ResponseInterface;
}