<?php


namespace iikoExchangeBundle\Library\base\Schedule;


class EventSchedule extends Schedule
{
	protected array $events = [];

	public function __construct(array $events)
	{
		$this->events = $events;
	}

	public function returnType(): string
	{
		return self::TYP_EVENTS;
	}

	public function readOnly(): bool
	{
		return true;
	}

	public function jsonSerialize()
	{
		return parent::jsonSerialize() +  ['events' => $this->events];
	}
}