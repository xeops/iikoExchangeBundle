<?php


namespace iikoExchangeBundle\Contract\Mapping;


interface MappingCollectionItemInterface
{
	/**
	 * @return MappingItemInterface[]
	 */
	public function getIdentifiers() : array;

	/**
	 * @return MappingItemInterface[]
	 */
	public function getValues() : array;

	/**
	 * @param array $identifiers
	 */
	public function setIdentifiers(array $identifiers) : void;

	/**
	 * @param array $values
	 */
	public function setValues(array $values) : void;
}