<?php


namespace iikoExchangeBundle\Contract\Configuration;

use iikoExchangeBundle\Contract\ConfigItemInterface;
use iikoExchangeBundle\Contract\iikoWeb\Entity\Account;
use iikoExchangeBundle\Contract\iikoWeb\Entity\StoreConfiguration;


interface ConfigurableInterface
{
	/**
	 * @param ConfigManagerInterface $configManager
	 * @return mixed
	 */
	public function setConfigManager(ConfigManagerInterface $configManager);

	/**
	 * @param ConfigDirectoryInterface $directory
	 */
	public function registerConfigStack(ConfigDirectoryInterface $directory);

	public function withDomain(string $domain) : self;
}