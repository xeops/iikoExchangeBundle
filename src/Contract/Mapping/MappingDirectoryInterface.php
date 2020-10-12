<?php


namespace iikoExchangeBundle\Contract\Mapping;


use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

interface MappingDirectoryInterface
{
	public function __construct(LoggerInterface $logger, EventDispatcherInterface  $dispatcher, MappingStorageInterface $mappingStorage);

	public function getMapping(string $exchangeCode, string $mappingCode) : MappingInterface;

	/**
	 * @param string $exchangeCode
	 * @return MappingInterface[]
	 */
	public function getMappingList(string $exchangeCode) : array;

	public function registerMapping(string $exchangeCode, MappingInterface $mappingCode);
}