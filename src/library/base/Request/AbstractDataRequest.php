<?php


namespace iikoExchangeBundle\Library\base\Request;

use iikoExchangeBundle\Contract\ConfigInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;
use iikoExchangeBundle\Contract\DataRequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractDataRequest implements DataRequestInterface
{
	protected $timeOut = 30;

	public function getTimeOut(): int
	{
		return $this->timeOut;
	}
}