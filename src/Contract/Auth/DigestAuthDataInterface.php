<?php


namespace iikoExchangeBundle\Contract\Auth;


use iikoExchangeBundle\Contract\AuthDataInterface;

interface DigestAuthDataInterface extends AuthDataInterface, DigestAuthDataBuilderInterface
{
	public function getUrl(): string;

	public function getUserName(): string;

	public function getPassword(): string;

	public function getKey(): string;

	public function getValue(): ?string;

	const TYPE_HEADER_KEY = 'HEADER_KEY';
	const TYPE_QUERY_KEY = 'QUERY_KEY';

	public function getType(): string;
}