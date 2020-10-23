<?php


namespace iikoExchangeBundle\Library\iiko\Connection;


use iikoExchangeBundle\Contract\AuthStorageInterface;
use iikoExchangeBundle\Library\base\Connection\ExchangeDataProvider;
use Psr\Log\LoggerInterface;

class iikoProvider extends ExchangeDataProvider
{
	/** @var LoggerInterface */
	protected LoggerInterface $logger;
	/** @var AuthStorageInterface */
	protected AuthStorageInterface $authStorage;

	public function __construct()
	{
	}

	public function getCode(): string
	{
		return 'iiko';
	}
}