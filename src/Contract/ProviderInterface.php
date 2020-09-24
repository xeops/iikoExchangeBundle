<?php


namespace iikoExchangeBundle\Contract;


interface ProviderInterface
{
	public function withConnection(ConnectionInterface $connection) : self;

	public function getConnection() : ConnectionInterface;
}