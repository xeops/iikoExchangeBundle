<?php


namespace iikoExchangeBundle\Library\base\Config\Event;


use iikoExchangeBundle\Contract\Configuration\ConfigBuildDirectoryEventInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigDirectoryInterface;
use Symfony\Component\EventDispatcher\Event;

class ConfigDirectoryBuild extends Event implements ConfigBuildDirectoryEventInterface
{
	private  $directory;



	public function __construct(ConfigDirectoryInterface  $directory)
	{
		$this->directory = $directory;
	}

	/**
	 * @return ConfigDirectoryInterface
	 */
	public function getDirectory(): ConfigDirectoryInterface
	{
		return $this->directory;
	}

}