<?php


namespace iikoExchangeBundle\Contract;


interface FetcherInterface
{
	public function setProvider();

	public function fetchData() : ResponseInterface;
}