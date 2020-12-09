<?php


namespace iikoExchangeBundle\Library\base\Exchange\Event;

use iikoExchangeBundle\Contract\Exchange\Event\ExchangeOnProcessEvent;
use iikoExchangeBundle\Contract\Exchange\ExchangeInterface;
use Symfony\Component\EventDispatcher\Event;

class ExchangeProcessEvent extends Event implements ExchangeOnProcessEvent
{

	/**
	 * @var ExchangeInterface
	 */
	private ExchangeInterface $exchange;

	public function __construct(ExchangeInterface $exchange)
	{
		$this->exchange = $exchange;
	}

	public function getExchange(): ExchangeInterface
	{
		return $this->exchange;
	}
}