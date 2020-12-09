<?php


namespace iikoExchangeBundle\Library\base\Exchange\Engine;


use iikoExchangeBundle\Library\base\Exchange\Engine\Event\EngineLoadEvent;
use Psr\Log\LoggerInterface;

class EngineLoadEventTrigger
{
	/**
	 * @var LoggerInterface
	 */
	private LoggerInterface $logger;

	public function __construct(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	public function onExchangeEngineLoad(EngineLoadEvent $event)
	{
		$event->getEngine()->getExchange()->getUploadProvider()->sendRequest($event->getEngine()->getLoadRequest());
	}
}