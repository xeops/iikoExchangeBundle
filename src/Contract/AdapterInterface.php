<?php


namespace iikoExchangeBundle\Contract;


interface AdapterInterface
{
	public function getConfig() : ?AdapterConfigInterface;

	public function adapt($data);
}