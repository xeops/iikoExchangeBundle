<?php


namespace iikoExchangeBundle\Contract\Mapping;


use iikoExchangeBundle\Contract\ConfigItemInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;
use iikoExchangeBundle\Contract\Event\ExchangeStartEventInterface;

interface MappingInterface extends \JsonSerializable, ConfigurableInterface
{
	/**
	 * @return string
	 */
	public function getCode() : string;

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