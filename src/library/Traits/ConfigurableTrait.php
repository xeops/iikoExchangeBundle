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

		if (array_key_exists($configCode, $this->configuration))
		{
			if ($configValue instanceof ConfigItemInterface)
			{
				$this->configuration[$configCode] = $configValue;
			}
			else
			{
				$this->configuration[$configCode]->setValue($configValue);
			}
		}

	}

	public function setConfiguration(array $configuration): void
	{
		foreach ($configuration as $configCode => $configValue)
		{
			$this->setConfigurationItem($configCode, $configValue);
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

	public function getConfigValue($key)
	{
		return $this->configuration[$key]->getValue();
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