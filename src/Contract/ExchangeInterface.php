<?php


namespace iikoExchangeBundle\Contract;


interface ExchangeInterface extends ExchangeBuilderInterface
{
	public function getCode() : string;

	public function register();

	public function process();
}