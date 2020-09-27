<?php


namespace iikoExchangeBundle\Library\base\Request;

use iikoExchangeBundle\Contract\DataRequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractDataRequest implements DataRequestInterface
{
	abstract public function processResponse($body);
}