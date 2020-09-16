<?php


namespace iikoExchangeBundle\iikoExchangeBundle\Contract;


interface ResponseInterface
{
	public function getStatusCode();

	public function getReasonPhrase();
}