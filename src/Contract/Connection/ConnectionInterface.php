<?php


namespace iikoExchangeBundle\Contract\Connection;


use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use Psr\Http\Message\ResponseInterface;

interface ConnectionInterface extends ConfigurableInterface
{
	public function sendRequest(DataRequestInterface $request): ResponseInterface;
}