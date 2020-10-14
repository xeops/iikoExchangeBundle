<?php


namespace iikoExchangeBundle\Contract;


interface AuthStorageInterface
{
	public function storeAuthData(string $unique, \JsonSerializable $data);

	public function getAuthData(string $unique) : ?string;

	public function threadLock(string $unique);
}