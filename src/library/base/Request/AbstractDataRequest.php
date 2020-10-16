<?php


namespace iikoExchangeBundle\Library\base\Request;

use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Library\Traits\ConfigurableTrait;

abstract class AbstractDataRequest implements DataRequestInterface
{
	use ConfigurableTrait;

	public function jsonSerialize()
	{
		return [
			self::FIELD_CODE => $this->getCode(),
			self::FIELD_CONFIGURATION => $this->getConfiguration()
		];
	}

	public function getTimeOut(): int
	{
		return 30;
	}
}