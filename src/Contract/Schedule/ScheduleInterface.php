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

	const FIELD_TYPE = 'type';
	const FIELD_READONLY = 'readOnly';
	const FIELD_VALUE = 'value';

	public function returnType() : string;

	public function readOnly() : bool;

	public function getValue();

	public static function deserialize($config) : ScheduleInterface;
}