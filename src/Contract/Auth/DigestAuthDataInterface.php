<?php


namespace iikoExchangeBundle\Contract\Auth;


use iikoExchangeBundle\Contract\AuthDataInterface;

interface DigestAuthDataInterface extends AuthDataInterface, DigestAuthDataBuilderInterface
{
	public function getUrl(): string;

	public function getUserName(): string;

	public function getPassword(): string;

	public function getTokenName(): string;

	public function getToken(): ?string;

	const TOKEN_TYPE_HEADER = 'HEADER';
	const TOKEN_TYPE_QUERY = 'QUERY';

	public function getTokenType(): string;
}