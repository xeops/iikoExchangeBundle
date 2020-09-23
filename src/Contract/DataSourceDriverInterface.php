<?php


namespace iikoExchangeBundle\Contract;

/**
 * Интерфейс драйвера служит для определения поведения источника
 * Interface Driver
 * @package iikoExchangeBundle\Contract
 */
interface DataSourceDriverInterface
{
	public function load(?RequestInterface $request = null) : ResponseInterface;

	public static function getBaseRequest() : RequestInterface;
}