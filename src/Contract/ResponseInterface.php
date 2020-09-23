<?php


namespace iikoExchangeBundle\Contract;


interface ResponseInterface
{
	public function getStatusCode();

	public function getReasonPhrase();
}