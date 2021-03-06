<?php


namespace iikoExchangeBundle\Library\base\Schedule;


use iikoExchangeBundle\Contract\CalendarPeriodInterface;
use iikoExchangeBundle\Contract\Schedule\ScheduleInterface;

class SimplePeriodicalCronSchedule extends CronSchedule
{
	const FIELD_PERIOD_DIFF_TYPE = 'period_diff_type';
	const FIELD_PERIOD_COUNT = 'period_count';
	const FIELD_PERIOD_TYPE = 'period_type';

	const FIELD_CONSTANTS = 'constants';

	const FIELD_DIFF_TYPES = ['previous', 'current', 'next'];
	//TODO constants
	const FIELD_PERIOD_TYPES = ['hour', 'day', 'week', 'month', 'year'];

	const TYPE = 'SIMPLE_PERIOD_CRONTAB';

	protected string $diffType = 'last';
	protected int $count = 1;
	protected string $periodType = 'day';

	public function returnType(): string
	{
		return self::TYPE;
	}

	public function jsonSerialize()
	{
		return
			parent::jsonSerialize()
			+
			[
				self::FIELD_PERIOD_DIFF_TYPE => $this->diffType,
				self::FIELD_PERIOD_COUNT => $this->count,
				self::FIELD_PERIOD_TYPE => $this->periodType,
				self::FIELD_CONSTANTS =>
					[
						'FIELD_DIFF_TYPES' => self::FIELD_DIFF_TYPES,
						'FIELD_PERIOD_TYPES' => self::FIELD_PERIOD_TYPES
					]
			];
	}

	public static function deserialize($config): ScheduleInterface
	{
		/** @var SimplePeriodicalCronSchedule $schedule */
		$schedule = parent::deserialize($config);
		$schedule->diffType = $config[self::FIELD_PERIOD_DIFF_TYPE];
		$schedule->count = $config[self::FIELD_PERIOD_COUNT];
		$schedule->periodType = $config[self::FIELD_PERIOD_TYPE];

		return $schedule;
	}

	/**
	 * @param \DateTime|null $fromDate
	 * @return CalendarPeriodInterface
	 * @throws \Exception
	 */
	public function getPeriod(?\DateTime $fromDate = null)
	{
		throw new \Exception("Method is realized in main iikoweb project");
	}
}