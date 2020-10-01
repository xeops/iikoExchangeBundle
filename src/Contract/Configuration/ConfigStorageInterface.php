<?php


namespace iikoExchangeBundle\Contract\Configuration;


use iikoExchangeBundle\Contract\ConfigItemInterface;
use iikoExchangeBundle\Contract\iikoWeb\Entity\Account;
use iikoExchangeBundle\Contract\iikoWeb\Entity\StoreConfiguration;

interface ConfigStorageInterface
{
	/**
	 * @param $domain
	 * @param $config
	 * @param $code
	 * @param $account
	 * @param null $restaurant
	 * @return mixed
	 */
	public function saveConfig($domain, $code, $config, $account, $restaurant = null) : bool;

	/**
	 * @param $domain
	 * @param $code
	 * @param $account
	 * @param null $restaurant
	 * @return mixed
	 */
	public function getConfig($domain, $code, $account, $restaurant = null) : ?ConfigItemInterface;

	/**
	 * @param $domain
	 * @param $account
	 * @param null $restaurant
	 * @return ConfigItemInterface[]
	 */
	public function getMany($domain, $account, ?array $codes = null, $restaurant = null) : ?array;
}