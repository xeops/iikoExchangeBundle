<?php


namespace iikoExchangeBundle\Contract;


interface AuthStorageInterface
{
	public function storeAuthData( AuthDataInterface $data);

	public function getAuthData() : AuthDataInterface;
}