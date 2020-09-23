<?php


namespace iikoExchangeBundle\Contract;


interface AdapterInterface
{
	public function getConfig() : ?AdapterConfigInterface;
}