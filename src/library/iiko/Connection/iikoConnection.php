<?php


namespace iikoExchangeBundle\Library\iiko\Connection;


use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Query;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\RequestOptions;
use iikoExchangeBundle\Library\base\Connection\AbstractDigestConnection;
use iikoExchangeBundle\Library\base\Connection\TokenAuthData;

class iikoConnection extends AbstractDigestConnection
{
	const CODE = 'iiko';

	public function getCode(): string
	{
		return self::CODE;
	}

	protected function login()
	{
		$this->authStorage->threadLock($this->getLoginInfoUnique());

		$handlers = HandlerStack::create();
		$this->pushLoggerHandler($handlers);

		$client = (new Client(['base_uri' => $this->getConfigValue(self::CONFIG_HOST), 'http_errors' => false, 'handler' => $handlers]));

		$request = new Request(
			'GET',
			(new Uri('/resto/api/auth'))->withQuery(Query::build(
				[
					"login" => $this->getConfigValue(self::CONFIG_LOGIN),
					"pass" => $this->getConfigValue(self::CONFIG_PASSWORD),
					"client-type" => "iikoweb-exchange"
				]
			))

		);

		$response = $client->send($request, [RequestOptions::TIMEOUT => 5]);

		if ($response->getStatusCode() === 200)
		{
			$this->authData = new TokenAuthData($response->getBody()->__toString());
			$this->authStorage->storeAuthData($this->getLoginInfoUnique(), $this->authData);
		}
		else
		{
			$this->logger->critical("EXCHANGE_EXCEPTION", ['exception' => $response->getBody(), 'code' => $response->getStatusCode(), 'reason' => $response->getReasonPhrase()]);
			throw new \Exception("IIKO_CONNECTION_ERROR", $response->getStatusCode());
		}
	}
}