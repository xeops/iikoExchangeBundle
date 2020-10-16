<?php


namespace iikoExchangeBundle\Library\base\Config\Types;

use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;

abstract class AbstractConfigItem implements ConfigItemInterface
{
	protected $value;
	protected bool $required;

	public function __construct($default = null, bool $required = true)
	{
		$this->setValue($default);
		$this->required = $required;
	}

	public function getRequired(): bool
	{
		return $this->required;
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
			self::FIELD_TYPE => $this->getType(),
			self::FIELD_VALUE => $this->normalize(),
			self::FIELD_REQUIRED => $this->getRequired()
		];
	}
}