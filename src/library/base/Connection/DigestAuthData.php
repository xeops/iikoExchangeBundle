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
	protected $key = 'key';
	protected $value;
	protected $type = self::TYPE_HEADER_KEY;

	public static function restoreFromStorage():AuthDataInterface
	{
		// TODO: Implement restoreFromStorage() method.
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

	public function setKey(string $key): DigestAuthDataBuilderInterface
	{
		$this->key = $key;
		return $this;
	}

	public function setValue(string $value): DigestAuthDataBuilderInterface
	{
		$this->value = $value;
		return $this;
	}

	public function setType(string $value): DigestAuthDataBuilderInterface
	{
		$this->type = $value;
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

	public function getKey(): string
	{
		return $this->key;
	}

	public function getValue(): ?string
	{
		return $this->value;
	}

	public function getType(): string
	{
		return $this->type;
	}

	public function jsonSerialize()
	{
		return [
			'url' => $this->getUrl(),
			'userName' => $this->getUserName(),
			'password' => $this->getPassword(),
			'type' => $this->getType(),
			'key' => $this->getKey(),
			'value' => $this->getValue()
		];
	}
}