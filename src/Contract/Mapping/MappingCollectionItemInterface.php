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
}