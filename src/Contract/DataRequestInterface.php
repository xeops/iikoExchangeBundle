<?php


namespace iikoExchangeBundle\Contract;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface DataRequestInterface
{
	public function getCode();

	public function getRequest(): RequestInterface;

	public function getConfig(): ?ConfigInterface;

	public function setConfig(ConfigInterface $config) : self;

	public function processResponse($body);

	public function processError(ResponseInterface $response);

	public function getTimeOut() : int;
}