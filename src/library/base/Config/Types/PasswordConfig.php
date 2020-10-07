<?php


namespace iikoExchangeBundle\Library\base\Config\Types;


use iikoExchangeBundle\Contract\ConfigItemInterface;

class PasswordConfig extends AbstractConfigItem
{
	public function getCode(): string
	{
		return "password";
	}

	public function getType(): string
	{
		return self::TYPE_PASSWORD;
	}
}