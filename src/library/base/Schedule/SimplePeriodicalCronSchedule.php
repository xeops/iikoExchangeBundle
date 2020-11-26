<?php


namespace iikoExchangeBundle\Library\base\Schedule;


class SimplePeriodicalCronSchedule extends CronSchedule
{
	protected string $type;
	protected int $number;
	protected string $periodType;


	public function jsonSerialize()
	{
		return parent::jsonSerialize() + ['type' => $this->type, 'number' => $this->number, 'periodType' => $this->periodType];
	}
}