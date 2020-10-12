<?php


namespace iikoExchangeBundle\Library\base\Mapping;


use iikoExchangeBundle\Contract\Mapping\MappingDirectoryBuildEvent;
use iikoExchangeBundle\Contract\Mapping\MappingDirectoryInterface;
use Symfony\Component\EventDispatcher\Event;

class BuildEvent extends Event implements MappingDirectoryBuildEvent
{
	protected MappingDirectoryInterface $directory;

	public function __construct(MappingDirectoryInterface $directory)
	{
		$this->directory = $directory;
	}

	/**
	 * @return MappingDirectoryInterface
	 */
	public function getDirectory(): MappingDirectoryInterface
	{
		return $this->directory;
	}
}