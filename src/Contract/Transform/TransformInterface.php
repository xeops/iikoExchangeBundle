<?php


namespace iikoExchangeBundle\Contract\Transform;


use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;

interface TransformInterface extends ConfigurableInterface, \JsonSerializable
{
	public function exposeMapping() : array;
}