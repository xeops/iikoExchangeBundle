<?php


namespace iikoExchangeBundle\Contract\Exchange\Engine\Event;


use iikoExchangeBundle\Contract\Engine\ExchangeEngineInterface;
use iikoExchangeBundle\Contract\Exchange\ExchangeInterface;

interface ExchangeEngineStartEventInterface
{
	public function getEngine(): ExchangeEngineInterface;

	public function getExchange(): ExchangeInterface;
}