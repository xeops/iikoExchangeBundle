<?php


namespace iikoExchangeBundle\Library\base\Connection;


use iikoExchangeBundle\Contract\Auth\DigestAuthDataBuilderInterface;
use iikoExchangeBundle\Contract\Auth\TokenAuthDataInterface;
use iikoExchangeBundle\Contract\AuthDataInterface;

class TokenAuthData implements TokenAuthDataInterface
{

	protected $token;

	public function __construct(string $token)
	{
		$this->token = $token;
	}

	public function jsonSerialize()
	{
		return $this->token;
	}

	public static function jsonDeserialize(string $json): AuthDataInterface
	{
		return new static((string)json_decode($json));
	}

	public function getToken(): ?string
	{
		return $this->token;
	}

	public function setToken(string $token)
	{
		$this->token = $token;
	}
}