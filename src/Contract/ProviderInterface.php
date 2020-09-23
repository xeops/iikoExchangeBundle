<?php


namespace iikoExchangeBundle\Contract;


interface ProviderInterface
{
	public function withConnection() : self;

	public function getConnection() : ConnectionInterface;
}