<?php


namespace iikoExchangeBundle\Contract\Configuration;


interface ConfigBuildDirectoryEventInterface
{
	const EVENT_NAME = 'exchange.config.event.directory_build';

	public function __construct(ConfigDirectoryInterface $directory);

	public function getDirectory() : ConfigDirectoryInterface;

}