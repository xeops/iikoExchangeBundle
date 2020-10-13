<?php


namespace iikoExchangeBundle\Contract\Mapping;


use iikoExchangeBundle\Contract\ConfigItemInterface;
use iikoExchangeBundle\Contract\Event\ExchangeStartEventInterface;

interface MappingInterface extends \JsonSerializable
{
	/**
	 * @return string
	 */
	public function getCode() : string;

	/**
	 * @return ConfigItemInterface[]
	 */
	public function getConfig() : array;

	/**
	 * @param array $data
	 * @return void
	 */
	public function fillMapping(array $data);

	/**
	 * @param array $data
	 * @return mixed
	 */
	public function clearSession(ExchangeStartEventInterface $event);
}