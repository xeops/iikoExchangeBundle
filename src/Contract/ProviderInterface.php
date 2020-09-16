<?php


namespace iikoExchangeBundle\iikoExchangeBundle\Contract;


interface ProviderInterface
{
	public function sendRequest(RequestInterface  $request);
}