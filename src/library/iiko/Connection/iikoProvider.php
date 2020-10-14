<?php


namespace iikoExchangeBundle\Library\iiko\Connection;


use iikoExchangeBundle\Contract\AuthStorageInterface;
use iikoExchangeBundle\Library\base\Connection\AbstractProvider;
use Psr\Log\LoggerInterface;

class iikoProvider extends AbstractProvider
{
	/** @var LoggerInterface */
	protected $logger;
	/** @var AuthStorageInterface */
	protected $authStorage;

	public function __construct(LoggerInterface $logger, AuthStorageInterface $storage)
	{
		$this->logger = $logger;
		$this->authStorage = $storage;
	}

	public function getCode(): string
	{
		return 'iiko';
	}
}