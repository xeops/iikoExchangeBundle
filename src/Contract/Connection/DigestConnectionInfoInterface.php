<?php


namespace iikoExchangeBundle\Contract\Connection;


interface DigestConnectionInfoInterface extends ConnectionInfoInterface
{
	public function __construct(string $host, string $userName, string $password);

	public function getHost(): string;

	public function getUserName(): string;

	public function getPassword(): string;

}