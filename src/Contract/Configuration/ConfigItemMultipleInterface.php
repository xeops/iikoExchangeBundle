<?php


namespace iikoExchangeBundle\Contract\Configuration;


use iikoExchangeBundle\Contract\ConfigItemInterface;

interface ConfigItemMultipleInterface extends ConfigItemInterface
{
	public function getOptionSet() : array;
}