<?php


namespace iikoExchangeBundle\Library\base\Connection;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use iikoExchangeBundle\Contract\AuthDataInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class BaseDigestConnection extends BaseConnection
{
	const KEY_HEADER = 'HEADER';
	const KEY_QUERY = 'QUERY';

	public function setAuthData(?AuthDataInterface $authData)
	{
		if(empty($authData))
		{
			throw new \Exception('');
		}
	}

	public function getAuthData($authData): ?AuthDataInterface
	{

	}

	public function sendRequest(RequestInterface $request): ResponseInterface
	{

	}

	public function getClient(): ClientInterface
	{
		return (new Client(['base_uri' => $this->authStorage->getAuthData(), 'handler' => $this->getHandlers(), 'http_errors' => false]));
	}


	private function getHandlers(): HandlerStack
	{
		$handlers = HandlerStack::create();

		$key = "iikoweb_exchange_unresolved";

		$handlers->push(Middleware::mapRequest(function (RequestInterface $request) use (&$key)
		{
			$loginResponse = $this->login();
			if ($loginResponse->getStatusCode() === 200)
			{
				$key = $loginResponse->getBody()->getContents();
			}
			else
			{
				throw new \Exception($loginResponse->getReasonPhrase(), $loginResponse->getStatusCode());
			}
			$request = $request->withUri(Uri::withQueryValue($request->getUri(), 'key', $key));

			return $request;

		}));

		$handlers->push(Middleware::mapResponse(function (ResponseInterface $response) use ($key)
		{
			try
			{
				$this->invalidateKey($key);
			}
			catch (\Exception $exception)
			{
				$this->logger->critical(__METHOD__, ['exception' => $exception->getMessage(), 'code' => $exception->getCode()]);
			}

			return $response;
		}));


		return $handlers;
	}
}