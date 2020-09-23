<?php


namespace iikoExchangeBundle\Directory;


use iikoExchangeBundle\Contract\ExchangeInterface;
use iikoExchangeBundle\Event\BuildExchangeDirectoryEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ExchangeDirectory
{
	private $directory = [];
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var EventDispatcherInterface
	 */
	private $dispatcher;

	public function __construct(LoggerInterface $logger, EventDispatcherInterface $dispatcher)
	{
		$this->logger = $logger;
		$this->dispatcher = $dispatcher;
	}

	public function register(ExchangeInterface $exchange)
	{
		$this->directory[$exchange->getCode()] = $exchange;
	}

	public function getExchanges()
	{
		if (empty($this->directory))
		{
			$this->dispatcher->dispatch(BuildExchangeDirectoryEvent::NAME, new BuildExchangeDirectoryEvent($this));
		}

		return $this->directory;
	}
}