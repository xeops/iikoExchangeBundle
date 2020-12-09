<?php


namespace iikoExchangeBundle\Library\base\Exchange\Engine;


use iikoExchangeBundle\Contract\Exchange\Engine\Event\ExchangeEngineStartEventInterface;
use iikoExchangeBundle\Library\base\Exchange\Engine\Event\ExchangeEngineStartEvent;
use iikoExchangeBundle\Library\base\Exchange\Event\ExchangeProcessEvent;
use Psr\Log\LoggerInterface;

class ExchangeStartEventTrigger
{
	/**
	 * @var LoggerInterface
	 */
	private LoggerInterface $logger;

	public function __construct(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	public function onExchangeStart(ExchangeProcessEvent $event)
	{
		foreach ($event->getExchange()->getEngines() as $engine)
		{
			$engine->process();
		}
	}
}