<?php


namespace iikoExchangeBundle\Library\base\Request;

use iikoExchangeBundle\Contract\ConfigItemInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;

abstract class AbstractDataRequest implements DataRequestInterface
{
	/**
	 * @var ConfigItemInterface[]
	 */
	protected $config;

	public function getConfig(): array
	{
		return [];
	}

	public function fillConfig(array $config)
	{
		$this->config = $config;
	}
}