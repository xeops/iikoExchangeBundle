<?php


namespace iikoExchangeBundle\Contract\Schedule;


/**
 * Интерфейс для различных триггеров старта обмена.
 * Interface ScheduleInterface
 * @package iikoExchangeBundle\Contract\Schedule
 */
interface ScheduleInterface extends \JsonSerializable
{
	const TYPE_MANUAL = 'manual';

	const TYPE_CRON = 'cron';

	const TYP_EVENTS = 'event';

	public function returnType() : string;

	public function readOnly() : bool;

}