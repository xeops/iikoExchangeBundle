<?php


namespace iikoExchangeBundle\Library\base\Config\Types;


class UrlConfigItem extends AbstractConfigItem
{

	public function getType(): string
	{
		return self::TYPE_URL;
	}
}