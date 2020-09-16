<?php

namespace iikoExchangeBundle\iikoExchangeBundle\Contract;

interface DataSourceInterface
{
	public function load(DataSourceDriverInterface $driver) : ResponseInterface;
}