<?php


namespace iikoExchangeBundle\Contract;


use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;
use iikoExchangeBundle\Contract\Mapping\MappingInterface;

interface AdapterInterface extends \JsonSerializable, ConfigurableInterface
{
	public function getCode() : string;
	/**
	 * @return ConfigItemInterface[]
	 */

	/**
	 * @param MappingInterface $mapping
	 * @return mixed
	 */
	public function addMapping(MappingInterface $mapping);

	/**
	 * @return MappingInterface[]
	 */
	public function getMapping() : array;
	/**
	 * @param ExchangeInterface $exchange
	 * @param string $requestCode
	 * @param mixed $data
	 * @return mixed
	 */
	public function adapt(ExchangeInterface $exchange, string $requestCode, $data);
}