<?php


namespace iikoExchangeBundle\Contract\Configuration;


use iikoExchangeBundle\Contract\ConfigItemInterface;

interface ConfigDirectoryInterface
{
	/**
	 * @param string $domain
	 * @param string $code
	 * @return ConfigItemInterface[]
	 */
	public function getList(string $domain, ?string $code = null) : array;

	/**
	 * @param $domain
	 * @param $code
	 * @param ConfigItemInterface $configItem
	 * @return ConfigDirectoryInterface
	 */
	public function registerConfigItem($domain, $code, ConfigItemInterface $configItem) : ConfigDirectoryInterface;

}