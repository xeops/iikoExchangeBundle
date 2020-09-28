<?php


namespace iikoExchangeBundle\Library\iiko\Connection;


use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\RequestOptions;
use iikoExchangeBundle\Contract\Auth\TokenAuthDataInterface;
use iikoExchangeBundle\Contract\AuthDataInterface;
use iikoExchangeBundle\Library\base\Connection\AbstractDigestConnection;
use iikoExchangeBundle\Library\base\Connection\TokenAuthData;
use function GuzzleHttp\Psr7\build_query;

class iikoConnection extends AbstractDigestConnection
{
	protected function login()
	{
		$this->authStorage->threadLock($this->connectionInfo);

		$handlers = HandlerStack::create();
		$this->pushLoggerHandler($handlers);

		$client = (new Client(['base_uri' => $this->connectionInfo->getHost(), 'http_errors' => false, 'handler' => $handlers]));

		$request = new Request(
			'GET',
			(new Uri('/resto/api/auth'))->withQuery(build_query(
				[
					"login" => $this->connectionInfo->getUserName(),
					"pass" => $this->connectionInfo->getPassword(),
					"client-type" => "iikoweb-exchange"
				]
			))

		);

		$response = $client->send($request, [RequestOptions::TIMEOUT => 5]);

		if ($response->getStatusCode() === 200)
		{
			$this->authData = new TokenAuthData($response->getBody()->__toString());
			$this->authStorage->storeAuthData($this->connectionInfo, $this->authData);
		}
		else
		{
			$this->logger->critical("EXCHANGE_EXCEPTION", ['exception' => $response->getBody(), 'code' => $response->getStatusCode(), 'reason' => $response->getReasonPhrase()]);
			throw new \Exception("IIKO_CONNECTION_ERROR", $response->getStatusCode());
		}
	}

	protected function transformAuthData(?string $data): ?AuthDataInterface
	{
		return $data ? (new TokenAuthData(json_decode($data))) : null;
	}
}