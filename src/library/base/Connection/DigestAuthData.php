<?php


namespace iikoExchangeBundle\Library\base\Connection;


use iikoExchangeBundle\Contract\Auth\DigestAuthDataBuilderInterface;
use iikoExchangeBundle\Contract\Auth\DigestAuthDataInterface;
use iikoExchangeBundle\Contract\AuthDataInterface;

class DigestAuthData implements DigestAuthDataInterface
{

	protected $url;
	protected $password;
	protected $userName;
	protected $tokenName = 'key';
	protected $token;
	protected $tokenType = self::TOKEN_TYPE_HEADER;

	public static function restoreFromStorage():AuthDataInterface
	{

	}

	public function setUrl(string $url): DigestAuthDataBuilderInterface
	{
		$this->url = $url;
		return $this;
	}

	public function setUserName(string $userName): DigestAuthDataBuilderInterface
	{
		$this->userName = $userName;
		return $this;
	}

	public function setPassword(string $password): DigestAuthDataBuilderInterface
	{
		$this->password = $password;
		return $this;
	}

	public function setTokenName(string $key): DigestAuthDataBuilderInterface
	{
		$this->tokenName = $key;
		return $this;
	}

	public function setToken(string $value): DigestAuthDataBuilderInterface
	{
		$this->token = $value;
		return $this;
	}

	public function getUrl(): string
	{
		return $this->url;
	}

	public function getUserName(): string
	{
		return $this->userName;
	}

	public function getPassword(): string
	{
		return $this->password;
	}

	public function getTokenName(): string
	{
		return $this->tokenName;
	}

	public function getToken(): ?string
	{
		return $this->token;
	}

	public function setTokenType(string $tokenType): DigestAuthDataBuilderInterface
	{
		$this->tokenType = $tokenType;
		return $this;
	}
	public function getTokenType(): string
	{
		return self::TOKEN_TYPE_QUERY;
	}

	public function jsonSerialize()
	{
		return [
			'url' => $this->getUrl(),
			'userName' => $this->getUserName(),
			'password' => $this->getPassword(),
			'type' => $this->getTokenType(),
			'tokenName' => $this->getTokenName(),
			'token' => $this->getToken()
		];
	}
}