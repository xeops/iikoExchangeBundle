<?php


namespace iikoExchangeBundle\Library\iiko\Connection;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use iikoExchangeBundle\Contract\Auth\DigestAuthDataInterface;
use iikoExchangeBundle\Library\base\Connection\AbstractDigestConnection;
use function GuzzleHttp\Psr7\build_query;

class iikoConnection extends AbstractDigestConnection
{
	protected function login()
	{
		$client = (new Client(['base_uri' => $this->getAuthData()->getUrl(), 'http_errors' => false]));

		$request = new Request(
			'GET',
			(new Uri('/resto/api/auth'))->withQuery(build_query(
				[
					"login" => $this->getAuthData()->getUserName(),
					"pass" => $this->getAuthData()->getPassword(),
					"client-type" => "iikoweb-exchange"
				]
			))
		);

		$response = $client->send($request);
		if ($response->getStatusCode() === 200)
		{

			$this->setAuthData($this->getAuthData()->setTokenType(DigestAuthDataInterface::TOKEN_TYPE_HEADER)->setTokenName($response->getBody()->__toString()));
		}
		else
		{
			$this->logger->critical("EXCHANGE_EXCEPTION", ['exception' => $response->getBody(), 'code' => $response->getStatusCode(), 'reason' => $response->getReasonPhrase()]);
			throw new \Exception("IIKO_CONNECTION_ERROR", $response->getStatusCode());
		}
	}

}