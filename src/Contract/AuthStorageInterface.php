<?php


namespace iikoExchangeBundle\Contract;


use iikoExchangeBundle\Contract\Connection\ConnectionInfoInterface;

interface AuthStorageInterface
{
	public function storeAuthData(ConnectionInfoInterface $connectionInfo, AuthDataInterface $data);

	public function getAuthData(ConnectionInfoInterface $connectionInfo) : ?string;

	public function threadLock(ConnectionInfoInterface $connectionInfo);
}