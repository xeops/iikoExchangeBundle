<?php


namespace iikoExchangeBundle\Library\base\Mapping;


use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;
use iikoExchangeBundle\Contract\Mapping\MappingInterface;
use iikoExchangeBundle\Library\Traits\ConfigurableTrait;

/**
 * Class AbstractMapping
 * @package iikoExchangeBundle\Library\base\Mapping
 */
abstract class AbstractMapping implements MappingInterface
{

	public function setMappingList(array $data)
	{
		// identifiers sector
		//
	}

	/**
	 * @inheritDoc
	 */
	public function getValuesByIdentifiers(array $search): array
	{

	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return [
			self::FIELD_CODE => $this->getCode(),
			self::FIELD_IDENTIFIERS => $this->exposeIdentifiers(),
			self::FIELD_VALUES => $this->exposeValues()
		];
	}
}