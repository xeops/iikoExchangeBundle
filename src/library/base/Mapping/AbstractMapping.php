<?php


namespace iikoExchangeBundle\Library\base\Mapping;


use iikoExchangeBundle\Contract\Mapping\MappingInterface;

/**
 * Class AbstractMapping
 * @package iikoExchangeBundle\Library\base\Mapping
 */
abstract class AbstractMapping implements MappingInterface
{
	protected ?MappingCollectionList $collection = null;

	/**
	 * @inheritDoc
	 */
	public function getCollection(): ?MappingCollectionList
	{
		return $this->collection;
	}

	/**
	 * @inheritDoc
	 */
	public function setMappingList(MappingCollectionList $data)
	{
		$this->collection = $data;
		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return [
			self::FIELD_CODE => $this->getCode(),
			self::FIELD_IDENTIFIERS => $this->exposeIdentifiers(),
			self::FIELD_VALUES => $this->exposeValues(),
			self::FIELD_COLLECTION => $this->getCollection()
		];
	}
}