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
	public function setConfigManager(ConfigManagerInterface $configManager) : self;

	/**
	 * @param ConfigDirectoryInterface $directory
	 */
	public function registerConfigStack(ConfigDirectoryInterface $directory);

	/**
	 * Create new instance with new domain and clean up previous configuration set, such as account, restaurant and etc.
	 * @param string $domain
	 * @return $this
	 */
	public function withDomain(string $domain) : self;
}