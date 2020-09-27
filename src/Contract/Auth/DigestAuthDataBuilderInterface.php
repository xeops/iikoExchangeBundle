<?php


namespace iikoExchangeBundle\Contract\Auth;


interface DigestAuthDataBuilderInterface
{
	public function setUrl(string $url) : self;

	public function setTokenType(string $type) : self;

	public function setUserName(string $userName) : self;

	public function setPassword(string $password) : self;

	public function setTokenName(string $key) : self;

	public function setToken(string $value) : self;
}