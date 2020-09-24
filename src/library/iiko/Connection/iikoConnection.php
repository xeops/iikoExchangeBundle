<?php


namespace iikoExchangeBundle\Library\iiko\Connection;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use iikoExchangeBundle\Contract\Auth\DigestAuthDataInterface;
use iikoExchangeBundle\Library\base\Connection\AbstractDigestConnection;

class iikoConnection extends AbstractDigestConnection
{
	protected function login()
	{
		$client = (new Client(['base_uri' => $this->getAuthData()->getUrl(), 'http_errors' => false]));

		$request = new Request(
			'GET',
			'/resto/api/auth',
			["Accept" => "text/html,text/plain"],
			["login" => $this->getAuthData()->getUserName(), "pass" => $this->getAuthData()->getPassword(), "client-type" => "iikoweb-exchange"]
		);

		$response = $client->send($request);
		if ($response->getStatusCode() === 200)
		{

			$this->setAuthData($this->getAuthData()->setType(DigestAuthDataInterface::TYPE_HEADER_KEY)->setKey($response->getBody()->__toString()));
		}
		else
		{
			$this->logger->critical("EXCHANGE_EXCEPTION", ['exception' => $response->getBody(), 'code' => $response->getStatusCode(), 'reason' => $response->getReasonPhrase()]);
			throw new \Exception("IIKO_CONNECTION_ERROR", $response->getStatusCode());
		}
	}

}