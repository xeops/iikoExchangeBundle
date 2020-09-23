<?php


namespace iikoExchangeBundle\Contract;


interface AuthStorageInterface
{
	public function storeAuthData($data);

	public function getAuthData();
}