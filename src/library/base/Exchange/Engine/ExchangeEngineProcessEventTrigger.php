<?php


namespace iikoExchangeBundle\Library\base\Exchange\Engine;


use iikoExchangeBundle\Library\base\Exchange\Engine\Event\ExchangeEngineStartEvent;
use Psr\Log\LoggerInterface;

class ExchangeEngineProcessEventTrigger
{
	/**
	 * @var LoggerInterface
	 */
	private LoggerInterface $logger;

	public function __construct(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	public function onEngineProcess(ExchangeEngineStartEvent $event)
	{
		$event->getEngine()->process();
	}
}