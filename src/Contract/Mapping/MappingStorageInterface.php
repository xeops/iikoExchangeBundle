<?php


namespace iikoExchangeBundle\Contract\Mapping;


interface MappingStorageInterface
{
	public function getConfig(string $exchangeCode, string $mappingCode);

	public function getConfigValue(string $exchangeCode, string $mappingCode, string $configCode);
}