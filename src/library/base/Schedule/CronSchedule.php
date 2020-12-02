<?php


namespace iikoExchangeBundle\Library\base\Schedule;


use iikoExchangeBundle\Contract\Schedule\ScheduleInterface;

class CronSchedule extends Schedule
{

	public function returnType(): string
	{
		return self::TYPE_CRON;
	}

	public static function deserialize($config): ScheduleInterface
	{
		$schedule = new static();

		$schedule->value = $config['value'];

		return $schedule;
	}


}