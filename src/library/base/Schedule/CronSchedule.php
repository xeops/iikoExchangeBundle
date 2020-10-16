<?php


namespace iikoExchangeBundle\Library\base\Schedule;


class CronSchedule extends Schedule
{

	public function returnType(): string
	{
		return self::TYPE_CRON;
	}

}