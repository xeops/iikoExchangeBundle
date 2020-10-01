<?php


namespace iikoExchangeBundle\Contract\Configuration;


use iikoExchangeBundle\Contract\ConfigItemInterface;
use iikoExchangeBundle\Contract\iikoWeb\Entity\Account;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

interface ConfigManagerInterface
{
	public function __construct(LoggerInterface $logger, ConfigStorageInterface $storage, ConfigDirectoryInterface  $directory, EventDispatcherInterface $dispatcher);

	/**
	 * @param $domain
	 * @param Account $account
	 * @param null $code
	 * @param null $storeConfiguration
	 * @return ConfigItemInterface[]
	 */
	public function getConfig(string $domain, $account, ?string $code = null, $storeConfiguration = null) : array;

	/**
	 * @param string $domain
	 * @param Account $account
	 * @param string $code
	 * @param $config
	 * @return mixed
	 */
	public function saveConfig(string $domain, $account, string $code, ConfigItemInterface $config, $restaurant = null);

	/**
	 * @param $account
	 * @param $domain
	 * @param null $storeConfiguration
	 * @return mixed
	 */
	public function exposeConfigurations($account, $domain, $storeConfiguration = null);
}