<?php


namespace iikoExchangeBundle\Library\base\Exchange\Engine\Event;


use iikoExchangeBundle\Contract\Engine\ExchangeEngineInterface;
use iikoExchangeBundle\Contract\Exchange\Engine\Event\ExchangeEngineStartEventInterface;
use iikoExchangeBundle\Contract\Exchange\ExchangeInterface;
use Symfony\Contracts\EventDispatcher\Event;

class ExchangeEngineStartEvent extends Event implements ExchangeEngineStartEventInterface
{
	/**
	 * @var ExchangeEngineInterface
	 */
	private ExchangeEngineInterface $engine;

	public function __construct(ExchangeEngineInterface $engine)
	{
		$this->engine = $engine;
	}

	public function getEngine(): ExchangeEngineInterface
	{
		return $this->engine;
	}

	public function getExchange(): ExchangeInterface
	{
		return $this->engine->getExchange();
	}
}
