<?php


namespace iikoExchangeBundle\Contract;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ProviderInterface
{
	public function sendRequest(DataRequestInterface $request);

	public function withConnection(ConnectionInterface $connection, bool $applyToCurrent = false) : self;

	public function getConnection() : ConnectionInterface;
}