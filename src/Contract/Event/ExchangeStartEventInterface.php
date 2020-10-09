<?php


namespace iikoExchangeBundle\Contract\Event;


use iikoExchangeBundle\Contract\ExchangeInterface;
use Symfony\Component\EventDispatcher\Event;

interface ExchangeStartEventInterface
{
	const NAME = 'exchange.start';

	public function getExchange(): ExchangeInterface;
}