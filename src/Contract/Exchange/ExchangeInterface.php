<?php


namespace iikoExchangeBundle\Contract\Exchange;


use iikoExchangeBundle\Contract\Engine\ExchangeEngineInterface;
use iikoExchangeBundle\Contract\ExchangeNodeInterface;
use iikoExchangeBundle\Contract\ProviderInterface;
use iikoExchangeBundle\Contract\Schedule\ScheduleInterface;

interface ExchangeInterface extends \JsonSerializable, ExchangeNodeInterface
{
	const FIELD_ENGINE = 'engines';
	const FIELD_SCHEDULE = 'schedules';

	public function addEngine(ExchangeEngineInterface $engine): self;

	public function addSchedule(ScheduleInterface $schedule): self;

	/** @return ExchangeEngineInterface[] */
	public function getEngines(): array;

	/** @return ScheduleInterface[] */
	public function getSchedules(): array;

	public function process(): void;

	public function setDownloadProvider(ProviderInterface $provider);

	public function setUploadProvider(ProviderInterface $provider);

	/** @return ProviderInterface */
	public function getDownloadProvider(): ProviderInterface;

	/** @return ProviderInterface */
	public function getUploadProvider(): ProviderInterface;


}