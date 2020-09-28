<?php


namespace iikoExchangeBundle\Contract\Auth;


use iikoExchangeBundle\Contract\AuthDataInterface;

interface TokenAuthDataInterface extends AuthDataInterface
{
	public function getToken() : ?string;

	public function setToken(string $token);
}