<?php


namespace iikoExchangeBundle\Library\base\Config\Types;


use iikoExchangeBundle\Contract\ConfigItemInterface;

class PasswordConfigItem extends AbstractConfigItem
{
	public function getType(): string
	{
		return self::TYPE_PASSWORD;
	}
}