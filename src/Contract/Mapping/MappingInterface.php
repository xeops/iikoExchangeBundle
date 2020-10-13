<?php


namespace iikoExchangeBundle\Contract\Mapping;


use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;

interface MappingInterface extends \JsonSerializable, ConfigurableInterface
{
	/**
	 * @return string
	 */
	public function getCode(): string;

}