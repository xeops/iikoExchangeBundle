<?php


namespace iikoExchangeBundle\Contract\Exchange\Trigger;


use iikoExchangeBundle\Contract\Exchange\Event\ExchangeOnProcessEvent;


interface ExchangeOnProcessTriggerInterface
{
	public function onExchangeProcess(ExchangeOnProcessEvent $event);
}