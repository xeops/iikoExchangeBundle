<?php


namespace iikoExchangeBundle\Contract\Event;


use iikoExchangeBundle\Contract\ExchangeInterface;

interface ExchangeEndEventInterface
{
	const NAME = 'exchange.end';

	public function getExchange(): ExchangeInterface;
}