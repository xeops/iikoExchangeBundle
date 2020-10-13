<?php


namespace iikoExchangeBundle\Library\base\Schedule;


class ManualSchedule extends Schedule
{
	public function returnType(): string
	{
		return self::TYPE_MANUAL;
	}
}