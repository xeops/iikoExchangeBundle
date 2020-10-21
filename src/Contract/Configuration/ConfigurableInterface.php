<?php


namespace iikoExchangeBundle\Contract\Configuration;

/**
 * Интерфейс для обозначения конфигурируемых сущностей.
 * Interface ConfigurableInterface
 * @package iikoExchangeBundle\Contract\Configuration
 */
interface ConfigurableInterface
{
	const CONFIG_BASE_INDEX = '_base_';

	const FIELD_CODE = '_code';
	const FIELD_CONFIGURATION = '_configuration';

	/**
	 * Получает заполненную данными конфигурацию
	 * @return ConfigItemInterface[]
	 */
	public function getConfiguration() : array;

	/**
	 * Заполняет конфигурацию данными.
	 * @param string $configCode
	 * @param mixed $configValue
	 * @param null|int $restaurantId
	 */
	public function setConfigurationItem(string $configCode, $configValue);

	public function setConfiguration(array $configuration) : void;
	/**
	 * Обязательная функция очистки внутренних кешей.
	 * Так как предполагается работа через герман, сервисы будут создаваться 1 раз, а использоваться бесконечное множество под разных клиентов
	 * @return mixed
	 */
	public function clearSession();

	/**
	 * Код обязателен для идентификации настроек
	 * @return mixed
	 */
	public function getCode() : string;
}