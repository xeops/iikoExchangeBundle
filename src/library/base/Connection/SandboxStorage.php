<?php


namespace iikoExchangeBundle\Library\base\Connection;


use iikoExchangeBundle\Contract\AuthDataInterface;
use iikoExchangeBundle\Contract\AuthStorageInterface;
use iikoExchangeBundle\Contract\Connection\ConnectionInfoInterface;

/**
 * Temporary class for examples and tests
 * Class AbstractStorage
 * @package iikoExchangeBundle\Library\base\Connection
 */
final class SandboxStorage implements AuthStorageInterface
{
	private $data = [];

	public function storeAuthData(ConnectionInfoInterface $connectionInfo, AuthDataInterface $data)
	{
		$this->data[$connectionInfo->getUnique()] = $data;
	}

	public function getAuthData(ConnectionInfoInterface $connectionInfo) : ?string
	{
		return $this->data[$connectionInfo->getUnique()] ?? null;
	}

	public function threadLock(ConnectionInfoInterface $connectionInfo)
	{
		/**
		 * $step=0;
		 * while($this->database->exist($connectionInfo->getUnique() && $step++ < 10)
		 *      sleep(1);
		 *
		 */
	}
}