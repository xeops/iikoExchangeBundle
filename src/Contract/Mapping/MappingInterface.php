<?php


namespace iikoExchangeBundle\Contract\Mapping;


use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;

interface MappingInterface extends \JsonSerializable
{
	const FIELD_CODE = ConfigurableInterface::FIELD_CODE;

	const FIELD_IDENTIFIERS = '_identifiers';
	const FIELD_VALUES = '_values';


	/**
	 * @return string
	 */
	public function getCode(): string;

	/**
	 * @return ConfigItemInterface[]
	 */
	public function exposeIdentifiers() : array;

	/**
	 * @return ConfigItemInterface[]
	 */
	public function exposeValues() : array;

	/**
	 * @param array $search
	 * @return array
	 */
	public function getValuesByIdentifiers(array $search) : array;

	/**
	 * @param array $data [identifier{N}_code, value{N}_code]
	 * @return mixed
	 */
	public function setMappingList(array $data);
}