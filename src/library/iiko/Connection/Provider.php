<?php


namespace iiko\Connection;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use iikoExchangeBundle\iikoExchangeBundle\Contract\ConnectionInterface;
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
	 * @var ConnectionInterface
	 */
	private $connection;

	public function __construct(LoggerInterface $logger, ConnectionInterface $connection)
	{
		$this->logger = $logger;
		$this->connection = $connection;
	}

	public function sendRequest(RequestInterface $request)
	{
		return $this
			->connection
			->getClient()
			->request(
				$request->getMethod(),
				$request->getUri(),
				[
					RequestOptions::BODY => $request->getBody(),
					RequestOptions::HEADERS => $request->getHeaders(),
					RequestOptions::TIMEOUT => $request->getTimeOut()
				]
			);
	}
}