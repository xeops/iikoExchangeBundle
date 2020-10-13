<?php


namespace iikoExchangeBundle\Library\base\Schedule;


use iikoExchangeBundle\Contract\Schedule\ScheduleInterface;

abstract class Schedule implements ScheduleInterface
{
	public function jsonSerialize()
	{
		return [
			'type' => $this->returnType(),
			'readOnly' => $this->readOnly()
		];
	}

	public function readOnly(): bool
	{
		return false;
	}
}