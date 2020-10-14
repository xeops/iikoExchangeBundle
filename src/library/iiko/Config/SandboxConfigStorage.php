<?php


namespace iikoExchangeBundle\Library\iiko\Config;


use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigStorageInterface;
use iikoExchangeBundle\Contract\iikoWeb\Entity\Account;
use iikoExchangeBundle\Contract\iikoWeb\Entity\StoreConfiguration;

final class SandboxConfigStorage implements ConfigStorageInterface
{

	/** @var ConfigItemInterface[][][][] */
	private $data;

	/**
	 * @inheritDoc
	 */
	public function saveConfig($domain, $code, $config, $account, $restaurant = null): bool
	{
		$this->data[$domain][$account] = $this->data[$domain][$account] ?? [];
		$this->data[$domain][$account] = $this->data[$domain][$account] ?? [];
		$this->data[$domain][$account][$restaurant] = $this->data[$domain][$account][$restaurant] ?? [];
		$this->data[$domain][$account][$restaurant][$code] = $config;

		return true;
	}

	/**
	 * @inheritDoc
	 */
	public function getConfig($domain, $code, $account, $restaurant = null): ?ConfigItemInterface
	{
		return $this->data[$domain][$account][$restaurant][$code] ?? null;
	}

	/**
	 * @inheritDoc
	 */
	public function getMany($domain, $account, ?array $codes = null, $restaurant = null): ?array
	{
		if (empty($this->data) || !array_key_exists($domain, $this->data) || !array_key_exists($account, $this->data[$domain]) || !array_key_exists($restaurant, $this->data[$domain][$account]))
		{
			return null;
		}
		$stack = $this->data[$domain][$account][$restaurant];

		if ($codes === null)
		{
			return $stack;
		}

		return array_intersect_key($stack, array_flip($codes));
	}
}