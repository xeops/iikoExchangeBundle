<?php


namespace iikoExchangeBundle\Library\base\Config\Types;

use iikoExchangeBundle\Contract\ConfigItemInterface;

abstract class AbstractConfigItem implements ConfigItemInterface
{
	protected $value;

	public function __construct($value = null)
	{
		$this->value = $value;
	}


	public function getValue()
	{
		return $this->value;
	}

	public function normalize()
	{
		return $this->value;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return [
			'type' => $this->getType(),
			'value' => $this->normalize()
		];
	}
}