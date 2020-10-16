<?php


namespace iikoExchangeBundle\Library\base\Mapping;


use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;
use iikoExchangeBundle\Contract\Mapping\MappingInterface;
use iikoExchangeBundle\Library\Traits\ConfigurableTrait;

/**
 * Class AbstractMapping
 * @package iikoExchangeBundle\Library\base\Mapping
 * @method array getConfiguration Return an associative array. [0]['leftEmployee' => identifier 'rightEmployee' => 'identifier']
 */
abstract class AbstractMapping implements MappingInterface
{

	use ConfigurableTrait;

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return [
			self::FIELD_CODE => $this->getCode(),
			self::FIELD_CONFIGURATION => $this->getConfiguration()
		];
	}
}