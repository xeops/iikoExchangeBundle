<?php


namespace iikoExchangeBundle\Library\base\Adapter;


use iikoExchangeBundle\Contract\AdapterInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Contract\Mapping\MappingInterface;
use iikoExchangeBundle\Library\Traits\ConfigurableTrait;

abstract class AbstractAdapter implements AdapterInterface
{
	use ConfigurableTrait;

	protected array $mapping = [];
	protected array $requestCodes = [];

	/**
	 * @inheritDoc
	 */
	public function addMapping(MappingInterface $mapping)
	{
		$this->mapping[$mapping->getCode()] = $mapping;
		return $this;
	}

	public function getMapping(): array
	{
		return $this->mapping;
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return [
			self::FIELD_CODE=> $this->getCode(),
			self::FIELD_CONFIGURATION => $this->getConfiguration(),
			self::FIELD_MAPPING => $this->getMapping()
		];
	}

	public function setRequestCodes(array $requestCodes)
	{
		$this->requestCodes = $requestCodes;
	}

	public function isRequestAvailable(DataRequestInterface $request)
	{
		return in_array($request->getCode(), $this->requestCodes);
	}
}