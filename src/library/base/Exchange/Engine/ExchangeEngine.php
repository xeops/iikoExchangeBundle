<?php


namespace iikoExchangeBundle\Library\base\Exchange\Engine;


use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Contract\DataRequest\UploadDataRequestInterface;
use iikoExchangeBundle\Contract\Engine\ExchangeEngineInterface;
use iikoExchangeBundle\Contract\Exchange\Event\ExchangeOnProcessEvent;
use iikoExchangeBundle\Contract\Exchange\ExchangeInterface;
use iikoExchangeBundle\Contract\Mapping\MappingInterface;
use iikoExchangeBundle\Contract\Transform\TransformInterface;
use iikoExchangeBundle\Library\base\Exchange\Engine\Event\ExchangeEngineSendRequestEvent;
use iikoExchangeBundle\Library\base\Exchange\Engine\Event\ExchangeEngineStartEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ExchangeEngine implements ExchangeEngineInterface
{
	protected MappingInterface $mapping;
	protected array $data = [];
	protected UploadDataRequestInterface $uploadRequest;
	/** @var DataRequestInterface[] */
	protected array $downloadRequests;
	protected TransformInterface $transformer;
	protected string $code;
	protected ExchangeInterface $exchange;
	/**
	 * @var LoggerInterface
	 */
	private LoggerInterface $logger;
	/**
	 * @var EventDispatcherInterface
	 */
	private EventDispatcherInterface $dispatcher;

	public function __construct(string $code, LoggerInterface $logger, EventDispatcherInterface $dispatcher)
	{
		$this->code = $code;
		$this->logger = $logger;
		$this->dispatcher = $dispatcher;
	}

	public function setLoadRequest(UploadDataRequestInterface $request): ExchangeEngineInterface
	{
		$this->uploadRequest = $request;
		return $this;
	}

	public function addExtractRequest(DataRequestInterface $dataRequest): ExchangeEngineInterface
	{
		$this->downloadRequests[] = $dataRequest;
		return $this;
	}

	public function setTransformer(TransformInterface $transformer): ExchangeEngineInterface
	{
		$this->transformer = $transformer;
		return $this;
	}

	/**
	 * @return TransformInterface
	 */
	public function getTransformer(): TransformInterface
	{
		return $this->transformer;
	}

	public function run(): void
	{
		$this->dispatcher->dispatch('exchange.engine.start', new ExchangeEngineStartEvent($this));
	}

	public function getCode(): string
	{
		return $this->code;
	}

	public function onExchangeProcess(ExchangeOnProcessEvent $event)
	{
		$this->exchange = $event->getExchange();

		$this->run();
	}

	public function process()
	{
		$this->data = [];

		foreach ($this->downloadRequests as $request)
		{
			$this->data[$request->getCode()] = null;

			$this->dispatcher->dispatch('exchange.engine.sendRequest', new ExchangeEngineSendRequestEvent($this, $request));
		}
	}

	public function setData(DataRequestInterface $request, $data)
	{
		$this->data[$request->getCode()] = $data;
		if ($this->isDataFull())
		{
			$this->loadData();
		}
	}

	public function loadData()
	{
		$this->dispatcher->dispatch('exchange.engine.load',);
	}

	public function isDataFull(): bool
	{
		return count(array_filter($this->data, fn($item) => $item !== null)) === count($this->data);
	}

	/**
	 * @return MappingInterface
	 */
	public function getMapping(): MappingInterface
	{
		return $this->mapping;
	}

	/**
	 * @param MappingInterface $mapping
	 * @return ExchangeEngine
	 */
	public function setMapping(MappingInterface $mapping): ExchangeEngineInterface
	{
		$this->mapping = $mapping;
		return $this;
	}


	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return [
			self::FIELD_CODE => $this->getCode(),
			self::FIELD_TRANSFORMER => $this->getTransformer(),
			self::FIELD_LOAD_REQUEST => $this->getLoadRequest(),
			self::FIELD_EXTRACT_REQUEST => $this->getExtractRequests()
		];
	}

	public function getExchange(): ExchangeInterface
	{
		return $this->exchange;
	}

	public function getLoadRequest(): UploadDataRequestInterface
	{
		return $this->uploadRequest;
	}

	public function getExtractRequests(): array
	{
		return $this->downloadRequests;
	}
}