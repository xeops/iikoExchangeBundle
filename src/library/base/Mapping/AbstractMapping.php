<?php


namespace iikoExchangeBundle\Library\base\Mapping;


use iikoExchangeBundle\Contract\Event\ExchangeStartEventInterface;
use iikoExchangeBundle\Contract\Mapping\MappingInterface;
use iikoExchangeBundle\Library\Traits\ConfigurableTrait;

abstract class AbstractMapping implements MappingInterface
{

	use ConfigurableTrait;

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return [
			'code' => $this->getCode(),
			'config' => $this->getConfiguration()
		];
	}
}