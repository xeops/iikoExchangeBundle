<?php


namespace iikoExchangeBundle\Contract;


use GuzzleHttp\ClientInterface;

interface ConnectionInterface
{
	public function getClient(): ClientInterface;
}