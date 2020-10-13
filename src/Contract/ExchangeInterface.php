<?php


namespace iikoExchangeBundle\Contract;


use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;
use iikoExchangeBundle\Contract\Schedule\ScheduleInterface;

interface ExchangeInterface extends ExchangeBuilderInterface, \JsonSerializable, ConfigurableInterface
{
	public function getCode(): string;

	public function register(ExchangeBuildDirectoryEventInterface $event);

	public function process();



	public function asTables();
}