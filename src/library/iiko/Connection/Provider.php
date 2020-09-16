<?php


namespace iiko\Connection;


use GuzzleHttp\ClientInterface;
use iikoExchangeBundle\iikoExchangeBundle\Contract\ProviderInterface;
use iikoExchangeBundle\iikoExchangeBundle\Contract\RequestInterface;
use Psr\Log\LoggerInterface;

class Provider implements ProviderInterface
{
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var ClientInterface
	 */
	private $client;

	public function __construct(LoggerInterface $logger, ClientInterface $client)
	{
		$this->logger = $logger;
		$this->client = $client;
	}


	public function sendRequest(RequestInterface $request)
	{
		return $request->send();
	}
}