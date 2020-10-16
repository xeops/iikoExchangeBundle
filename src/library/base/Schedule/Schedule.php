<?php


namespace iikoExchangeBundle\Library\base\Schedule;


use iikoExchangeBundle\Contract\Schedule\ScheduleInterface;

abstract class Schedule implements ScheduleInterface
{
	protected $value = null;

	public function jsonSerialize()
	{
		return [
			self::FIELD_TYPE => $this->returnType(),
			self::FIELD_READONLY => $this->readOnly(),
			self::FIELD_VALUE => $this->getValue()
		];
	}

	public function readOnly(): bool
	{
		return false;
	}

	public function getValue()
	{
		return $this->value;
	}
}