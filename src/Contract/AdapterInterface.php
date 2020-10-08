<?php


namespace iikoExchangeBundle\Contract;


interface AdapterInterface
{
	/**
	 * @return ConfigItemInterface[]
	 */
	public function getConfig() : array;

	/**
	 * @param ExchangeInterface $exchange
	 * @param string $requestCode
	 * @param mixed $data
	 * @return mixed
	 */
	public function adapt(ExchangeInterface $exchange, string $requestCode, $data);
}