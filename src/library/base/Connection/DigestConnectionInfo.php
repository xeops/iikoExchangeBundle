<?php


namespace iikoExchangeBundle\Library\base\Connection;


use iikoExchangeBundle\Contract\Connection\DigestConnectionInfoInterface;

class DigestConnectionInfo implements DigestConnectionInfoInterface
{

	/**
	 * @var string
	 */
	private $host;
	/**
	 * @var string
	 */
	private $userName;
	/**
	 * @var string
	 */
	private $password;

	public function __construct(string $host, string $userName, string $password)
	{
		$this->host = $host;
		$this->userName = $userName;
		$this->password = $password;
	}

	/**
	 * @inheritDoc
	 */
	public function getUnique(): string
	{
		return "{$this->getHost()}:{$this->getUserName()}";
	}

	/**
	 * @return string
	 */
	public function getHost(): string
	{
		return $this->host;
	}

	/**
	 * @return string
	 */
	public function getUserName(): string
	{
		return $this->userName;
	}

	/**
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}

}