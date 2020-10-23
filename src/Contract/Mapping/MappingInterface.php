<?php


namespace iikoExchangeBundle\Contract\Mapping;


use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;
use iikoExchangeBundle\Library\base\Mapping\MappingCollectionList;

interface MappingInterface extends \JsonSerializable
{
	const FIELD_CODE = ConfigurableInterface::FIELD_CODE;

	const FIELD_IDENTIFIERS = '_identifiers';
	const FIELD_VALUES = '_values';
	const FIELD_COLLECTION = "_collection";

	/**
	 * @return string
	 */
	public function getCode(): string;

	/**
	 * @return ConfigItemInterface[]
	 */
	public function exposeIdentifiers(): array;

	/**
	 * @return ConfigItemInterface[]
	 */
	public function exposeValues(): array;

	/**
	 * @return MappingCollectionList
	 */
	public function getCollection(): ?MappingCollectionList;

	/**
	 * @param MappingCollectionList $data
	 * @return mixed
	 */
	public function setMappingList(MappingCollectionList $data);
}