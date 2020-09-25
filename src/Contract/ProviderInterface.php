<?php


namespace iikoExchangeBundle\Contract;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ProviderInterface
{
	public function sendRequest(RequestInterface $request) : ResponseInterface;

	public function withConnection(ConnectionInterface $connection) : self;

	public function getConnection() : ConnectionInterface;
}