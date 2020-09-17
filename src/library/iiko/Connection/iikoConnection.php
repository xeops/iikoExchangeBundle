<?php


namespace iiko\Connection;


use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use iikoExchangeBundle\iikoExchangeBundle\Contract\ConnectionInterface;
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

	private $key = '';

	public function __construct(LoggerInterface  $logger)
	{

		$this->logger = $logger;
	}

	public function getClient()
	{
		return (new \GuzzleHttp\Client(['base_uri' => $this->server, 'handler' => $this->getHandlers()]));
	}

	private function getHandlers(): HandlerStack
	{
		$handlers = HandlerStack::create();

		$handlers->push(Middleware::retry(function ($retries, RequestInterface $request, ?ResponseInterface $response = null, ?\Exception $exception = null)
		{
			if ($retries === 0 && $response && $response->getStatusCode() === 401)
			{
				$this->logger->warning("AMO_CRM", ['step' => '401 unauthorized', 'response' => $response->getReasonPhrase(), 'body' => $response->getBody()]);
				$this->refreshToken();
				return true;
			}
			return false;

		}));
		$handlers->push(Middleware::mapRequest(function (RequestInterface $request)
		{
			return $request->withHeader('Authorization', "{$this->getConnectionInfo('token_type')} {$this->getConnectionInfo('access_token')}");
		}));
		if ($this->isDebug)
		{
			$handlers->push(Middleware::log(new Logger('amo'), new MessageFormatter('{request} - {response}'), LogLevel::DEBUG));
		}

		return $handlers;
	}

	private function login()
	{
		$client = $this->getClient();

		$request = new Request(
			'GET',
			'/resto/api/auth',
			["Accept" => "text/html,text/plain"],
			["login" => $this->userName, "pass" => $this->passwordHash, "client-type" => "iikoweb-exchange"]
		);

		$client->send($request);
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