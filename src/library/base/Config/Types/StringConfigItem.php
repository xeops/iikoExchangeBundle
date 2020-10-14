<?php


namespace iikoExchangeBundle\Library\base\Config\Types;


use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;

class StringConfigItem extends AbstractConfigItem
{
	public function getCode(): string
	{
		return 'str';
	}

	public function getType(): string
	{
		return self::TYPE_STRING;
	}
}