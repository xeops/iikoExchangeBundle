<?php


namespace iikoExchangeBundle\Library\base\Exchange\Engine\Event;


use iikoExchangeBundle\Contract\Engine\ExchangeEngineInterface;
use Symfony\Component\EventDispatcher\Event;

class EngineLoadEvent extends Event
{
	/**
	 * @var ExchangeEngineInterface
	 */
	private ExchangeEngineInterface $engine;

	public function __construct(ExchangeEngineInterface $engine)
	{
		$this->engine = $engine;
	}

	/**
	 * @return ExchangeEngineInterface
	 */
	public function getEngine(): ExchangeEngineInterface
	{
		return $this->engine;
	}
}