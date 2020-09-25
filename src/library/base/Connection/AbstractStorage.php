<?php


namespace iikoExchangeBundle\Library\base\Connection;


use iikoExchangeBundle\Contract\AuthDataInterface;
use iikoExchangeBundle\Contract\AuthStorageInterface;

/**
 * Temporary class for examples and tests
 * Class AbstractStorage
 * @package iikoExchangeBundle\Library\base\Connection
 */
final class AbstractStorage implements AuthStorageInterface
{
	private $data;

	public function storeAuthData(AuthDataInterface $data)
	{
		$this->data = $data;
	}

	public function getAuthData() : AuthDataInterface
	{
		return $this->data;
	}
}