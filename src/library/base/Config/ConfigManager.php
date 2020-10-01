<?php


namespace iikoExchangeBundle\Library\base\Config;


use iikoExchangeBundle\Contract\ConfigItemInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigDirectoryInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigManagerInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigStorageInterface;
use iikoExchangeBundle\Contract\iikoWeb\Entity\Account;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ConfigManager implements ConfigManagerInterface
{

	/** @var LoggerInterface */
	private $logger;
	/** @var ConfigStorageInterface */
	private $storage;
	/** @var ConfigDirectoryInterface */
	private $directory;
	/** @var EventDispatcherInterface */
	private $dispatcher;

	public function __construct(LoggerInterface $logger, ConfigStorageInterface $storage, ConfigDirectoryInterface $directory, EventDispatcherInterface $dispatcher)
	{
		$this->logger = $logger;
		$this->storage = $storage;
		$this->directory = $directory;
		$this->dispatcher = $dispatcher;
	}

	/**
	 * @inheritDoc
	 */
	public function getConfig(string $domain, $account, ?string $code = null, $restaurant = null): array
	{
		$config = $this->directory->getList($domain, $code);
		$values = $this->storage->getMany($domain, $account, array_keys($config), $restaurant);
		if($values)
		{
			foreach ($values as $value)
			{
				foreach ($config as $code => $configItem)
				{

					if ($configItem->getCode() === $value->getCode())
					{
						$configItem->setValue($value->getValue());
					}
				}
			}
		}
		return $config;

	}

	/**
	 * @inheritDoc
	 */
	public function saveConfig(string $domain, $account, string $code, ConfigItemInterface $config, $restaurant = null)
	{
		$this->storage->saveConfig($domain, $code, $config, $account, $restaurant);
	}

	/**
	 * @inheritDoc
	 */
	public function exposeConfigurations($account, $domain, $storeConfiguration = null)
	{

	}
}