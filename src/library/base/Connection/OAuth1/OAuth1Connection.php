<?php


namespace iikoExchangeBundle\Library\base\Connection\OAuth1;

use GuzzleHttp\HandlerStack;
use iikoExchangeBundle\Contract\AuthDataInterface;
use iikoExchangeBundle\Contract\Connection\ConnectionInfoInterface;
use iikoExchangeBundle\Library\base\Connection\AbstractConnection;


class OAuth1Connection extends AbstractConnection
{

	public function getCode(): string
	{
		return "OAuth1";
	}

	protected function login()
	{
		// TODO: Implement login() method.
	}

	protected function pushAddAuthDataHandler(HandlerStack $handlerStack)
	{
		// TODO: Implement pushAddAuthDataHandler() method.
	}
}