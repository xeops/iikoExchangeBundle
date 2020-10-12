<?php


namespace iikoExchangeBundle\Contract\Mapping;


interface MappingDirectoryBuildEvent
{
	const CODE = 'exchange.mapping.directory.build';

	public function __construct(MappingDirectoryInterface $directory);

	public function getDirectory() : MappingDirectoryInterface;
}