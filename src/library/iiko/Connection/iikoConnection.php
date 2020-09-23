<?php


namespace iikoExchangeBundle\Library\iiko\Connection;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\RequestOptions;
use iikoExchangeBundle\Contract\ConnectionInterface;
use Monolog\Logger;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class iikoConnection implements ConnectionInterface
{
	/**
	 *
	 * @var string
	 */
	private $server;

	private $userName;

	private $passwordHash;
	/**
	 * @var LoggerInterface
	 */
	private $logger;


	public function __construct(LoggerInterface $logger)
	{

		$this->logger = $logger;
	}

	public function getClient(): ClientInterface
	{
		return (new Client(['base_uri' => $this->server, 'handler' => $this->getHandlers(), 'http_errors' => false]));
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

	private function login(): ResponseInterface
	{
		$client = (new Client(['base_uri' => $this->server, 'http_errors' => false]));

		$request = new Request(
			'GET',
			'/resto/api/auth',
			["Accept" => "text/html,text/plain"],
			["login" => $this->userName, "pass" => $this->passwordHash, "client-type" => "iikoweb-exchange"]
		);

		return $client->send($request);
	}

	private function invalidateKey($key): ResponseInterface
	{
		$client = (new Client(['base_uri' => $this->server, 'http_errors' => false]));
		$request = new Request(
			'GET',
			'/resto/api/logout',
			["Accept" => "text/html,text/plain"],
			["key" => $key, "client-type" => "iikoweb-exchange"]
		);

		return $client->send($request);
	}

	/**
	 * @param string $server
	 */
	public function setServer(string $server): void
	{
		$this->server = $server;
	}

	/**
	 * @param mixed $userName
	 */
	public function setUserName($userName): void
	{
		$this->userName = $userName;
	}

	/**
	 * @param mixed $passwordHash
	 */
	public function setPasswordHash($passwordHash): void
	{
		$this->passwordHash = $passwordHash;
	}
}