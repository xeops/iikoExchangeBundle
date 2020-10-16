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
	protected ?array $configuration = [];

	public function fillConfiguration(string $configCode, $configValue, ?int $restaurantId = null): void
	{
		$key = $restaurantId === null ? ConfigurableInterface::CONFIG_BASE_INDEX : $restaurantId;

		$this->configuration[$key] ??= $this->createConfig();

		if (array_key_exists($configCode, $this->configuration[$key]))
		{
			$this->configuration[$key][$configCode]->setValue($configValue);
		}

	}

	/**
	 * Получает заполненную данными конфигурацию
	 * @return ConfigItemInterface[]
	 */
	public function getConfiguration() : array
	{
		/** if config value is filled - ok, but if not - we should create */
		$this->configuration[ConfigurableInterface::CONFIG_BASE_INDEX] ??= $this->createConfig();

		return $this->configuration;
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
	protected function createConfig() : array
	{
		return [
			// new Config( .... )
		];
	}
}