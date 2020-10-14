<?php


namespace iikoExchangeBundle\Contract\Configuration;


use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;

interface ConfigItemMultipleInterface extends ConfigItemInterface
{
	public function getOptionSet() : array;
}