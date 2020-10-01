<?php


namespace iikoExchangeBundle\Library\base\Config;


use iikoExchangeBundle\Contract\ConfigItemInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigBuildDirectoryEventInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigDirectoryInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigStorageInterface;
use iikoExchangeBundle\Library\base\Config\Event\ConfigDirectoryBuild;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ConfigDirectory implements ConfigDirectoryInterface
{
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var EventDispatcherInterface
	 */
	private $dispatcher;

	/**
	 * @var ConfigItemInterface[][]
	 */
	private $list = null;

	public function __construct(LoggerInterface $logger, EventDispatcherInterface $dispatcher)
	{
		$this->logger = $logger;
		$this->dispatcher = $dispatcher;
	}

	/**
	 * @inheritDoc
	 */
	public function getList(?string $domain = null, ?string $code = null): array
	{
		return ($code === null ? $this->getConfig()[$domain] : [$code => $this->getConfig()[$domain][$code]]);
	}


	/**
	 * @return ConfigItemInterface[][]
	 */
	protected function getConfig()
	{
		if ($this->list === null)
		{
			$this->list = [];
			$this->dispatcher->dispatch(ConfigDirectoryBuild::EVENT_NAME, new ConfigDirectoryBuild($this));
		}
		return $this->list;
	}


	public function registerConfigItem($domain, $code, ConfigItemInterface $configItem): ConfigDirectoryInterface
	{
		$this->list[$domain] = $this->list[$domain] ?? [];
		$this->list[$domain][$code] = $configItem;

		return $this;
	}
}