<?php


namespace iikoExchangeBundle\Library\base\Config\Types;


class DatePeriodConfigItem extends AbstractConfigItem
{
	const  FIELD_FROM = 'from';
	const  FIELD_TO = 'to';

	protected string $from;
	protected string $to;

	public function setValue($value)
	{
		$value = json_decode($value, true);
		$this->from = $value[self::FIELD_FROM];
		$this->to = $value[self::FIELD_TO];

		return $this;
	}

	public function getValue()
	{
		return self::jsonEncodeVale();
	}

	public function getType(): string
	{
		return self::TYPE_PERIOD;
	}

	public function jsonEncodeVale()
	{
		return [self::FIELD_FROM => $this->from, self::FIELD_TO => $this->to];
	}


}