<?php


namespace iikoExchangeBundle\Service;


use Psr\Log\LoggerInterface;

class ExchangeProcessManager
{
	/**
	 * @var LoggerInterface
	 */
	private $logger;

	public function __construct(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}


	public function processStoreExchange($exchange, $store)
	{

	}
	public function processAccountExchange($exchange, $account)
	{

	}
}