<?php


namespace iikoExchangeBundle\Contract;


use Psr\Http\Message\RequestInterface;

interface DataDownloadRequestInterface
{
	public function getCode();

	public function getRequest(): RequestInterface;

	public function getConfig(): ?ConfigInterface;

	public function setConfig(ConfigInterface $config) : self;
}