<?php


namespace iikoExchangeBundle\Library\base\Request\Extract;


use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ExtractDataRequest implements DataRequestInterface
{

	/**
	 * @inheritDoc
	 */
	public function getConfiguration(): array
	{
		// TODO: Implement getConfiguration() method.
	}

	/**
	 * @inheritDoc
	 */
	public function setConfigurationItem(string $configCode, $configValue)
	{
		// TODO: Implement setConfigurationItem() method.
	}

	public function setConfiguration(array $configuration): void
	{
		// TODO: Implement setConfiguration() method.
	}

	public function getConfigValue(string $code)
	{
		// TODO: Implement getConfigValue() method.
	}

	public function getCode(): string
	{
		// TODO: Implement getCode() method.
	}

	public function getRequest(): RequestInterface
	{
		// TODO: Implement getRequest() method.
	}

	public function processResponse($body)
	{
		// TODO: Implement processResponse() method.
	}

	public function processError(ResponseInterface $response)
	{
		// TODO: Implement processError() method.
	}

	public function getTimeOut(): int
	{
		// TODO: Implement getTimeOut() method.
	}

	public function getHeaders(): array
	{
		// TODO: Implement getHeaders() method.
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		// TODO: Implement jsonSerialize() method.
	}
}