<?php


use iikoExchangeBundle\iikoExchangeBundle\Contract\DataSourceDriverInterface;
use iikoExchangeBundle\iikoExchangeBundle\Contract\ProviderInterface;
use iikoExchangeBundle\iikoExchangeBundle\Contract\RequestInterface;
use iikoExchangeBundle\iikoExchangeBundle\Contract\ResponseInterface;
use Psr\Log\LoggerInterface;
use xeops\iikoExchange\Drivers\iiko\Reports\iikoReportRequest;

class iikoOlapDriver implements DataSourceDriverInterface
{
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var ProviderInterface
	 */
	private $provider;

	public function __construct(LoggerInterface  $logger, ProviderInterface  $provider)
	{

		$this->logger = $logger;
		$this->provider = $provider;
	}

	public function load(RequestInterface $request) : ResponseInterface
	{
		$response = $this->provider->sendRequest($request);

		return $response;
	}
}