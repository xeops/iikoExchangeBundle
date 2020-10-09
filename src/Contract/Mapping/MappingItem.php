<?php


namespace iikoExchangeBundle\Contract\Mapping;


use iikoExchangeBundle\Contract\ConfigItemInterface;

interface MappingItem
{
	public function from() : ConfigItemInterface;

	public function to() : ConfigItemInterface;
}