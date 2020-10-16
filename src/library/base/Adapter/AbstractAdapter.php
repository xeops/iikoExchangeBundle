<?php


namespace iikoExchangeBundle\Library\base\Adapter;


use iikoExchangeBundle\Contract\AdapterInterface;
use iikoExchangeBundle\Contract\Mapping\MappingInterface;
use iikoExchangeBundle\Library\Traits\ConfigurableTrait;

abstract class AbstractAdapter implements AdapterInterface
{
	use ConfigurableTrait;

	protected array $mapping = [];

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
}