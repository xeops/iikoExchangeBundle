<?php


namespace iikoExchangeBundle\Library\Traits;


use iikoExchangeBundle\Contract\ConfigItemInterface;

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

	public function fillConfiguration(string $configCode, $configValue): void
	{
		$this->configuration ??= $this->createConfig();

		if (array_key_exists($configCode, $this->configuration))
		{
			$this->configuration[$configCode]->setValue($configValue);
		}
	}

	public function getConfiguration() : array
	{
		/** if config value is filled - ok, but if not - we should create */
		$this->configuration ??= $this->createConfig();

		return $this->configuration;
	}

	public function clearSession()
	{
		$this->configuration = null;
	}

	protected function createConfig()
	{
		return [
			// new Config( .... )
		];
	}
}