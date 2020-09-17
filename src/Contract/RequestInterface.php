<?php


namespace iikoExchangeBundle\iikoExchangeBundle\Contract;


interface RequestInterface
{
	public function getUri();

	public function getMethod();

	public function getHeaders();

	public function getBody();

	public function processResponse() : ResponseInterface;

	public function getTimeOut() : int;
}