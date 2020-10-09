<?php


namespace iikoExchangeBundle\Contract;


use iikoExchangeBundle\Contract\Mapping\MappingInterface;

interface AdapterInterface
{
	/**
	 * @return ConfigItemInterface[]
	 */
	public function getConfig() : array;

	/**
	 * @param MappingInterface $mapping
	 * @return mixed
	 */
	public function addMapping(MappingInterface $mapping);

	/**
	 * @param ExchangeInterface $exchange
	 * @param string $requestCode
	 * @param mixed $data
	 * @return mixed
	 */
	public function adapt(ExchangeInterface $exchange, string $requestCode, $data);
}