<?php


namespace iikoExchangeBundle\Event;


use iikoExchangeBundle\Contract\ExchangeBuildDirectoryEventInterface;
use iikoExchangeBundle\Contract\ExchangeDirectoryInterface;
use iikoExchangeBundle\Directory\ExchangeDirectory;
use Symfony\Component\EventDispatcher\Event;

class BuildExchangeDirectoryEvent extends Event implements ExchangeBuildDirectoryEventInterface
{
	const NAME = 'iiko_exchange.directory.exchanges.build';

	/**
	 * @var ExchangeDirectory
	 */
	private $directory;

	public function __construct(ExchangeDirectory $directory)
	{
		$this->directory = $directory;
	}

	/**
	 * @return ExchangeDirectory
	 */
	public function getDirectory(): ExchangeDirectoryInterface
	{
		return $this->directory;
	}


}