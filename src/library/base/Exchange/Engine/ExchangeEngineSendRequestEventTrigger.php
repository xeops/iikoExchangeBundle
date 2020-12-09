<?php


namespace iikoExchangeBundle\Library\base\Exchange\Engine;


use iikoExchangeBundle\Library\base\Exchange\Engine\Event\ExchangeEngineSendRequestEvent;
use Psr\Log\LoggerInterface;

class ExchangeEngineSendRequestEventTrigger
{
	/**
	 * @var LoggerInterface
	 */
	private LoggerInterface $logger;

	public function __construct(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	public function onEngineSendRequest(ExchangeEngineSendRequestEvent $event)
	{
		$data = $event->getEngine()->getExchange()->getDownloadProvider()->sendRequest($event->getRequest());
		$event->getEngine()->setData($event->getRequest(), $data);
	}
}