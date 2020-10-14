<?php


namespace iikoExchangeBundle\Library\base\Config\Types;


use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;

class DateDiffConfigItem extends AbstractConfigItem
{
	protected $value = '-1 day';

	public function getType(): string 
	{
		return self::TYPE_DATE_DIFF;
	}

	/**
	 * @inheritDoc
	 * @return string
	 */
	public function normalize()
	{
		return $this->value;
	}
}