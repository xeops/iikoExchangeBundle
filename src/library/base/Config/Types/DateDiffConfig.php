<?php


namespace iikoExchangeBundle\Library\base\Config\Types;


use iikoExchangeBundle\Contract\ConfigItemInterface;

class DateDiffConfig extends AbstractConfigItem
{
	protected $value = '-1 day';

	public function getCode(): string
	{
		return "DATE_DIFF";
	}

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