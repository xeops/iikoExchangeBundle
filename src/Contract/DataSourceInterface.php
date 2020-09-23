<?php

namespace iikoExchangeBundle\Contract;

interface DataSourceInterface
{
	public function load(DataSourceDriverInterface $driver) : ResponseInterface;
}