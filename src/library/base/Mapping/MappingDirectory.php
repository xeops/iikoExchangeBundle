<?php


namespace iikoExchangeBundle\Library\base\Mapping;


use iikoExchangeBundle\Contract\Mapping\MappingDirectoryInterface;
use iikoExchangeBundle\Contract\Mapping\MappingInterface;
use iikoExchangeBundle\Contract\Mapping\MappingStorageInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class MappingDirectory implements MappingDirectoryInterface
{
	/** @var MappingInterface[][] */
	protected ?array $directory = null;

	private LoggerInterface $logger;

	private MappingStorageInterface $mappingStorage;

	private EventDispatcherInterface $dispatcher;

	public function __construct(LoggerInterface $logger, EventDispatcherInterface $dispatcher, MappingStorageInterface $mappingStorage)
	{
		$this->logger = $logger;
		$this->mappingStorage = $mappingStorage;
		$this->dispatcher = $dispatcher;
	}

	public function getMapping(string $exchangeCode, ?string $mappingCode): MappingInterface
	{
		$exchangeDirectory = $this->getMappingList($exchangeCode);

		if (!array_key_exists($mappingCode, $exchangeDirectory))
		{

		}

		return $exchangeDirectory[$mappingCode];

	}

	public function getMappingList(string $exchangeCode): array
	{
		$directory = $this->getDirectory();

		if (!array_key_exists($exchangeCode, $directory))
		{

		}
		return $directory[$exchangeCode];
	}

	protected function getDirectory()
	{

		if (!$this->directory)
		{
			$this->directory = [];
			$this->dispatchEvent();
		}
		return $this->directory;
	}

	protected function fillMappingValues()
	{

	}

	protected function dispatchEvent()
	{
		$this->dispatcher->dispatch(BuildEvent::CODE, new BuildEvent($this));
	}

	public function registerMapping(string $exchangeCode, MappingInterface $mapping)
	{
		$this->directory[$exchangeCode] ??= [];
		$this->directory[$exchangeCode][$mapping->getCode()] = $mapping;
		return $this;
	}
}