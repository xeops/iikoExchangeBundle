<?php


namespace iikoExchangeBundle\Directory;


use iikoExchangeBundle\Contract\Exchange\ExchangeBuilderInterface;
use iikoExchangeBundle\Contract\ExchangeDirectoryInterface;
use iikoExchangeBundle\Contract\Exchange\ExchangeInterface;
use iikoExchangeBundle\Event\BuildExchangeDirectoryEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class ExchangeDirectory
 * @package iikoExchangeBundle\Directory
*/
class ExchangeDirectory implements ExchangeDirectoryInterface
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

	public function getExchanges(): array
	{
		if (empty($this->directory))
		{
			$this->invokeDirectory();
		}

		return $this->directory;
	}

	protected function invokeDirectory()
	{
		$this->dispatcher->dispatch(BuildExchangeDirectoryEvent::NAME, new BuildExchangeDirectoryEvent($this));
	}

	public function getExchangeByCode(string $code): ExchangeInterface
	{
		return $this->getExchanges()[$code];
	}

	public function registerExchange(ExchangeInterface $exchange): ExchangeDirectoryInterface
	{
		$this->directory[$exchange->getCode()] = $exchange;
		return $this;
	}
}