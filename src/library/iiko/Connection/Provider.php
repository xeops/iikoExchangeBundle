<?php


namespace iikoExchangeBundle\Library\iiko\Connection;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use iikoExchangeBundle\Contract\ConnectionInterface;
use iikoExchangeBundle\Contract\ProviderInterface;
use iikoExchangeBundle\Contract\RequestInterface;
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

	/**
	 * Return immutable provider
	 * @param $connection
	 * @return $this
	 */
	public function withConnection(ConnectionInterface $connection) : ProviderInterface
	{
		if($connection === $this->connection)
		{
			return $this;
		}
		$fetcher = clone $this;
		$fetcher->connection = $connection;

		return $fetcher;
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