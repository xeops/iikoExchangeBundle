<?php


namespace iikoExchangeBundle\Library\Traits;


use iikoExchangeBundle\Contract\CalendarPeriodInterface;


trait PeriodicalTrait
{
	# Class CalendarPeriodInterface - is copy past from iikoweb, do not use this as type

	/** @var CalendarPeriodInterface */
	protected $period;

	/**
	 * @param CalendarPeriodInterface $period
	 */
	public function setPeriod($period): void
	{
		$this->period = $period;
	}

	/**
	 * @return CalendarPeriodInterface
	 */
	public function getPeriod()
	{
		return $this->period;
	}
}