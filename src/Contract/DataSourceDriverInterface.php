<?php


namespace iikoExchangeBundle\iikoExchangeBundle\Contract;

/**
 * Интерфейс драйвера служит для определения поведения источника
 * Interface Driver
 * @package iikoExchangeBundle\iikoExchangeBundle\Contract
 */
interface DataSourceDriverInterface
{
	public function load(RequestInterface $request) : ResponseInterface;
}