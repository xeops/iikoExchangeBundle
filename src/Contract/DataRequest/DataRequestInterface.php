<?php


namespace iikoExchangeBundle\Contract\DataRequest;


use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

interface DataRequestInterface extends \JsonSerializable, ConfigurableInterface
{
	public function getCode();

	public function getRequest(): RequestInterface;

	public function processResponse($body);

	public function processError(ResponseInterface $response);

	public function getTimeOut() : int;
}