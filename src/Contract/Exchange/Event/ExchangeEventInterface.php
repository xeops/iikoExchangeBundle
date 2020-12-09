<?php


namespace iikoExchangeBundle\Contract\Exchange\Event;


use iikoExchangeBundle\Contract\Exchange\ExchangeInterface;

interface ExchangeEventInterface
{
	public function getExchange(): ExchangeInterface;
}