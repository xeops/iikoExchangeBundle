<?php


namespace iikoExchangeBundle\Contract\Configuration;

/**
 * Интерфейс для обозначения конфигурируемых сущностей.
 * Interface ConfigurableInterface
 * @package iikoExchangeBundle\Contract\Configuration
 */
interface ConfigurableInterface
{
	const FIELD_CONFIGURATION = 'configuration';

	/**
	 * Получает заполненную данными конфигурацию
	 * @return ConfigItemInterface[]
	 */
	public function getConfiguration(): array;

	/**
	 * Заполняет конфигурацию данными.
	 * @param string $configCode
	 * @param mixed $configValue
	 * @param null|int $restaurantId
	 */
	public function setConfigurationItem(string $configCode, $configValue);

	public function setConfiguration(array $configuration): void;

	public function getConfigValue(string $code);
}