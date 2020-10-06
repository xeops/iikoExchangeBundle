<?php


namespace iikoExchangeBundle\Library\base\Connection;


use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Uri;
use iikoExchangeBundle\Contract\Auth\TokenAuthDataInterface;
use iikoExchangeBundle\Contract\AuthDataInterface;
use iikoExchangeBundle\Contract\Connection\ConnectionInfoInterface;
use iikoExchangeBundle\Contract\Connection\DigestConnectionInfoInterface;
use iikoExchangeBundle\Contract\ConnectionInterface;
use iikoExchangeBundle\Contract\DataRequestInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractDigestConnection extends AbstractConnection
{
	const TOKEN_TYPE_QUERY = 'token_in_query';
	const TOKEN_TYPE_HEADER = 'token_in_header';

	protected $tokenName = 'key';
	protected $tokenType = self::TOKEN_TYPE_QUERY;
	/** @var DigestConnectionInfoInterface */
	protected $connectionInfo;
	/** @var TokenAuthDataInterface */
	protected $authData;

	protected function pushAddAuthDataHandler(HandlerStack $handlerStack)
	{
		if (empty($this->getAuthData()) || $this->getAuthData()->getToken() === null)
		{
			$this->login();
		}

		$handlerStack->push(Middleware::mapRequest(function (RequestInterface $request)
		{
			if ($this->tokenType === self::TOKEN_TYPE_QUERY)
			{
				$request = $request->withUri(Uri::withQueryValue($request->getUri(), $this->tokenName, $this->getAuthData()->getToken()));
			}
			if ($this->tokenType === self::TOKEN_TYPE_HEADER)
			{
				$request = $request->withHeader($this->tokenName, $this->getAuthData()->getToken());
			}
			return $request;

		}));
	}
}