<?php


namespace iikoExchangeBundle\Library\base\Adapter;


use iikoExchangeBundle\Contract\AdapterInterface;
use iikoExchangeBundle\Contract\ConfigItemInterface;
use iikoExchangeBundle\Contract\ExchangeInterface;
use iikoExchangeBundle\Contract\Mapping\MappingInterface;

abstract class AbstractAdapter implements AdapterInterface
{
	protected array $mapping;

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
			'code' => $this->getCode(),
			'config' => $this->getConfig(),
			'mapping' => $this->getMapping()
		];
	}
}