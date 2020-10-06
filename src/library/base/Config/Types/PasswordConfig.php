<?php


namespace iikoExchangeBundle\Library\base\Config\Types;


use iikoExchangeBundle\Contract\ConfigItemInterface;

class PasswordConfig implements ConfigItemInterface
{

	public function __construct($value = null)
	{
	}

	public function getCode(): string
	{
		// TODO: Implement getCode() method.
	}

	public function getType(): string
	{
		return self::TYPE_PASSWORD;
	}

	public function getValue()
	{
		// TODO: Implement getValue() method.
	}

	public function normalize()
	{
		// TODO: Implement normalize() method.
	}

	public function setValue($value)
	{
		// TODO: Implement setValue() method.
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return [

		];
	}
}