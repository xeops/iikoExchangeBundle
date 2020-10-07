<?php


namespace iikoExchangeBundle\Contract\DataRequest;


use iikoExchangeBundle\Contract\ConfigItemInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface DataRequestInterface
{
	public function getCode();

	public function getRequest(): RequestInterface;

	public function processResponse($body);

	public function processError(ResponseInterface $response);
	/**
	 * @return ConfigItemInterface[]
	 */
	public function getConfig() : array;

	/**
	 *
	 * @param array $config
	 * @return mixed
	 */
	public function fillConfig(array $config);
}