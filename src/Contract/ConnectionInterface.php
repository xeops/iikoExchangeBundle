<?php


namespace iikoExchangeBundle\Contract;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

interface ConnectionInterface
{
	public function setAuthData(?AuthDataInterface $authData);

	public function getAuthData() : ?AuthDataInterface;

	public function sendRequest(DataRequestInterface $request): ResponseInterface;

	public function setAuthStorage(AuthStorageInterface $authStorage) : self;

	public function setLogger(LoggerInterface $logger) : self;
}