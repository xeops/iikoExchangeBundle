<?php


namespace iikoExchangeBundle\Contract\Auth;


interface DigestAuthDataBuilderInterface
{
	public function setUrl(string $url) : self;

	public function setUserName(string $userName) : self;

	public function setPassword(string $password) : self;

	public function setKey(string $key) : self;

	public function setValue(string $value) : self;

	public function setType(string $value) : self;
}