<?php


namespace iikoExchangeBundle\Library\base\Mapping;


use iikoExchangeBundle\Contract\Event\ExchangeStartEventInterface;
use iikoExchangeBundle\Contract\Mapping\MappingInterface;

abstract class AbstractMapping implements MappingInterface
{

	protected ?array $data;


	/**
	 * @inheritDoc
	 */
	public function fillMapping(array $data)
	{
		$this->data = $data;
		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function checkMapping(array $data)
	{
		return is_array($data);
	}

	public function clearSession(ExchangeStartEventInterface $event)
	{
		$this->data = null;
		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return [
			'code' => $this->getCode(),
			'config' => $this->getConfig()
		];
	}
}