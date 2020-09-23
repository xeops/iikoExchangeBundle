<?php


namespace iikoExchangeBundle\Contract;


interface ExchangeDirectoryInterface
{
	/**
	 * @return ExchangeInterface[]
	 */
	public function getExchanges() : array;

	public function getExchangeByCode(string $code) : ExchangeInterface;

	public function registerExchange(ExchangeInterface $exchange) : self;
}