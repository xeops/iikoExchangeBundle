<?php


namespace iikoExchangeBundle\Contract;


interface ExchangeInterface extends ExchangeBuilderInterface
{
	public function getCode() : string;

	public function register(ExchangeBuildDirectoryEventInterface $event);

	public function process();
}