<?php


namespace iikoExchangeBundle\Library\base\Config\Types;


use iikoExchangeBundle\Contract\ConfigItemInterface;

class StringConfig implements ConfigItemInterface
{

	protected $value;

	public function __construct($value = null)
	{
		$this->value = $value;
	}

	public function getCode(): string
	{
		return 'str';
	}

	public function getType(): string
	{
		return self::TYPE_STRING;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function normalize()
	{
		return strval($this->value);
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
		return $this->value;
	}
}