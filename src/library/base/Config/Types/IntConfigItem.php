<?php


namespace iikoExchangeBundle\Library\base\Config\Types;


class IntConfigItem extends AbstractConfigItem
{

	public function getType(): string
	{
		return self::TYPE_INT;
	}
}