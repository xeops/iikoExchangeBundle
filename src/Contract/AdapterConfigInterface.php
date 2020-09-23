<?php


namespace iikoExchangeBundle\Contract;


interface AdapterConfigInterface
{
	const TYPE_MAPPING = 'MAPPING';

	public function getType() : string;

	public function saveConfig();

	public function getConfig();
}