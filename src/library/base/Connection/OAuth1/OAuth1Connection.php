<?php


namespace iikoExchangeBundle\Library\base\Connection\OAuth1;

use GuzzleHttp\HandlerStack;
use iikoExchangeBundle\Contract\AuthDataInterface;
use iikoExchangeBundle\Contract\Connection\ConnectionInfoInterface;
use iikoExchangeBundle\Library\base\Connection\AbstractConnection;


class OAuth1Connection extends AbstractConnection
{


	protected function transformAuthData(string $data): ?AuthDataInterface
	{

	}

	protected function login()
	{
		// TODO: Implement login() method.
	}

	protected function pushAddAuthDataHandler(HandlerStack $handlerStack)
	{

	}


	public function getConnectionConfig(): ConnectionInfoInterface
	{
		return new OAuth1ConnectionInfo();
	}
}