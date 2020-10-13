<?php


namespace iikoExchangeBundle\Contract\Configuration;

use iikoExchangeBundle\Contract\ConfigItemInterface;
use iikoExchangeBundle\Contract\iikoWeb\Entity\Account;
use iikoExchangeBundle\Contract\iikoWeb\Entity\StoreConfiguration;

/**
 * Интерфейс для обозначения конфигурируемых сущностей.
 * Interface ConfigurableInterface
 * @package iikoExchangeBundle\Contract\Configuration
 */
interface ConfigurableInterface
{
	/**
	 * Получает заполненную данными конфигурацию
	 * @return ConfigItemInterface[]
	 */
	public function getConfiguration() : array;

	/**
	 * Заполняет конфигурацию данными.
	 */
	public function fillConfiguration() : void;
}