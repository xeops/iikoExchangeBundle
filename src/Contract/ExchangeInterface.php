<?php


namespace iikoExchangeBundle\Contract;


use iikoExchangeBundle\Contract\Schedule\ScheduleInterface;

interface ExchangeInterface extends ExchangeBuilderInterface, \JsonSerializable
{
	public function getCode(): string;

	public function register(ExchangeBuildDirectoryEventInterface $event);

	public function process();

	/**
	 * @return ConfigItemInterface[]
	 */
	public function getConfig(): array;

	public function addSchedule(ScheduleInterface $schedule);

	public function getSchedules() : array;

	public function asTables();
}