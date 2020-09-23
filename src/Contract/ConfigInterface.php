<?php


namespace iikoExchangeBundle\Contract;


interface ConfigInterface
{
	/**
	 * @return ConfigItemInterface[]
	 */
	public function getItems();
}