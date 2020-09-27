<?php


namespace iikoExchangeBundle\Library\iiko\Request;


use iikoExchangeBundle\Contract\ConfigInterface;
use iikoExchangeBundle\Contract\DataRequestInterface;
use iikoExchangeBundle\Library\base\Request\AbstractDataRequest;
use Psr\Http\Message\RequestInterface;

class RoleDictionaryRequest extends AbstractDataRequest
{

	public function processResponse($body)
	{
		// TODO: Implement processResponse() method.
	}

	public function getCode()
	{
		// TODO: Implement getCode() method.
	}

	public function getRequest(): RequestInterface
	{
		// TODO: Implement getRequest() method.
	}

	public function getConfig(): ?ConfigInterface
	{
		// TODO: Implement getConfig() method.
	}

	public function setConfig(ConfigInterface $config): \iikoExchangeBundle\Contract\DataRequestInterface
	{
		return $this;
	}
}