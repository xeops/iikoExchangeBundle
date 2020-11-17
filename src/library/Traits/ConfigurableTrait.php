<?php


namespace iikoExchangeBundle\Library\Traits;


use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;

/**
 * Trait ConfigurableTrait
 * @package iikoExchangeBundle\Library\Traits
 */
trait ConfigurableTrait
{
	/**
	 * @var ConfigItemInterface[]
	 */
	protected ?array $configuration;

	public function setConfigurationItem(string $configCode, $configValue): void
	{
		$this->configuration ??= $this->createConfig();

		foreach ($this->configuration as $configItem)
		{
			if ($configItem->getCode() === $configCode)
			{
				$configItem->setValue($configValue);
			}
		}
	}

	/**
	 * @param $configuration
	 */
	public function setConfiguration(array $configuration): void
	{
		foreach ($configuration as $code => $config)
		{
			$this->setConfigurationItem($code, $config);
		}
	}

	/**
	 * Получает заполненную данными конфигурацию
	 * @return ConfigItemInterface[]
	 */
	public function getConfiguration(): array
	{
		/** if config value is filled - ok, but if not - we should create */
		$this->configuration ??= $this->createConfig();

		return $this->configuration;
	}

	public function getConfigValue(string $code)
	{
		foreach ($this->getConfiguration() as $configItem)
		{
			if ($configItem->getCode() === $code)
			{
				return $configItem->getValue();
			}
		}
		return null;
	}

	/**
	 * @inheritDoc
	 */
	public function clearSession()
	{
		$this->configuration = null;
	}

	/**
	 * @return ConfigItemInterface[]
	 */
	protected function createConfig(): array
	{
		return [
			// new Config( .... )
		];
	}
}