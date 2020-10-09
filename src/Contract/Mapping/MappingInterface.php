<?php


namespace iikoExchangeBundle\Contract\Mapping;


use iikoExchangeBundle\Contract\ConfigItemInterface;

interface MappingInterface
{
	public function getCode();

	/**
	 * @param string $source Source of data like iiko or Xero.
	 * @return mixed
	 */
	public function getMappingItem(string $source);

	public function exposeMapping() : array;

	public function fillMapping(array $data);

	public function checkMapping(array $data);

}