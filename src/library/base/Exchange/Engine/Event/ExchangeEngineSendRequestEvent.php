<?php


namespace iikoExchangeBundle\Library\base\Exchange\Engine\Event;


use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Contract\Engine\ExchangeEngineInterface;
use Symfony\Component\EventDispatcher\Event;

class ExchangeEngineSendRequestEvent extends Event
{
	/**
	 * @var ExchangeEngineInterface
	 */
	private ExchangeEngineInterface $engine;
	/**
	 * @var DataRequestInterface
	 */
	private DataRequestInterface $request;



	public function __construct(ExchangeEngineInterface $engine, DataRequestInterface $request)
	{
		$this->engine = $engine;
		$this->request = $request;
	}

	/**
	 * @return ExchangeEngineInterface
	 */
	public function getEngine(): ExchangeEngineInterface
	{
		return $this->engine;
	}

	/**
	 * @return DataRequestInterface
	 */
	public function getRequest(): DataRequestInterface
	{
		return $this->request;
	}
}