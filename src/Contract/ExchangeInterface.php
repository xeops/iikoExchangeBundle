<?php


namespace iikoExchangeBundle\Contract;


interface ExchangeInterface extends ExchangeBuilderInterface, \JsonSerializable
{
	public function getCode() : string;

	public function register(ExchangeBuildDirectoryEventInterface $event);

	public function process();

	/**
	 * @return ConfigItemInterface[]
	 */
	public function getConfig() : array;
}