<?php


namespace iikoExchangeBundle\Library\base\Schedule;


class CronSchedule extends Schedule
{
	protected string $expression;

	public function __construct($expression)
	{
		$this->expression = $expression;
	}

	public function returnType(): string
	{
		return self::TYPE_CRON;
	}

	public function jsonSerialize()
	{
		return parent::jsonSerialize() +  ['expression' => $this->expression];
	}
}