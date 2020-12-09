<?php


namespace iikoExchangeBundle\Library\base\Exchange;


use iikoExchangeBundle\Contract\Engine\ExchangeEngineInterface;
use iikoExchangeBundle\Contract\Exchange\ExchangeInterface;
use iikoExchangeBundle\Contract\ProviderInterface;
use iikoExchangeBundle\Contract\Schedule\ScheduleInterface;
use iikoExchangeBundle\Library\base\Exchange\Event\ExchangeProcessEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Exchange implements ExchangeInterface
{
	protected ProviderInterface $downloadProvider;
	protected ProviderInterface $uploadProvider;
	protected string $code;
	/**
	 * @var LoggerInterface
	 */
	protected LoggerInterface $logger;
	/**
	 * @var EventDispatcherInterface
	 */
	protected EventDispatcherInterface $dispatcher;

	/** @var ExchangeEngineInterface[] */
	protected array $engines = [];
	protected array $schedules = [];

	public function __construct(string $code, LoggerInterface $logger, EventDispatcherInterface $dispatcher)
	{
		$this->code = $code;
		$this->logger = $logger;
		$this->dispatcher = $dispatcher;
	}

	public function addEngine(ExchangeEngineInterface $engine): ExchangeInterface
	{
		$this->engines[] = $engine;
	}

	public function addSchedule(ScheduleInterface $schedule): ExchangeInterface
	{
		$this->schedules[] = $schedule;
		return $this;
	}

	public function process() : void
	{
		$this->dispatcher->dispatch('exchange.process', new ExchangeProcessEvent($this));
	}

	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return [
			self::FIELD_CODE => $this->getCode(),
			self::FIELD_ENGINE => $this->engines,
			self::FIELD_SCHEDULE => $this->schedules
		];
	}

	public function getEngines(): array
	{
		return $this->engines;
	}

	public function getSchedules(): array
	{
		return $this->schedules;
	}

	/**
	 * @return ProviderInterface
	 */
	public function getDownloadProvider(): ProviderInterface
	{
		return $this->downloadProvider;
	}

	/**
	 * @param ProviderInterface $provider
	 * @return Exchange
	 */
	public function setDownloadProvider(ProviderInterface $provider): Exchange
	{
		$this->downloadProvider = $provider;
		return $this;
	}

	/**
	 * @return ProviderInterface
	 */
	public function getUploadProvider(): ProviderInterface
	{
		return $this->uploadProvider;
	}

	/**
	 * @param ProviderInterface $provider
	 * @return Exchange
	 */
	public function setUploadProvider(ProviderInterface $provider): Exchange
	{
		$this->uploadProvider = $provider;
		return $this;
	}


}