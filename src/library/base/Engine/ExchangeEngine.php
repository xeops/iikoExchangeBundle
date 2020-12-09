<?php


namespace iikoExchangeBundle\Library\base\Engine;


use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Contract\DataRequest\UploadDataRequestInterface;
use iikoExchangeBundle\Contract\Engine\ExchangeEngineInterface;
use iikoExchangeBundle\Contract\Exchange\Event\ExchangeOnProcessEvent;
use iikoExchangeBundle\Contract\ProviderInterface;
use iikoExchangeBundle\Contract\Transform\TransformInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class ExchangeEngine implements ExchangeEngineInterface
{
	protected ExchangeEngineInterface $engine;
	protected array $dataRequests = [];
	protected array $transformers = [];
	protected UploadDataRequestInterface $loadRequest;
	private string $code;
	protected ProviderInterface $loadProvider;
	protected ProviderInterface $extractProvider;

	/**
	 * @var LoggerInterface
	 */
	private LoggerInterface $logger;
	/**
	 * @var EventDispatcherInterface
	 */
	private EventDispatcherInterface $eventDispatcher;

	public function __construct(string $code, LoggerInterface $logger, EventDispatcherInterface $eventDispatcher)
	{
		$this->code = $code;
		$this->logger = $logger;
		$this->eventDispatcher = $eventDispatcher;
	}

	public function setLoadRequest(UploadDataRequestInterface $request): ExchangeEngineInterface
	{
		$this->loadRequest = $request;
		return $this;
	}

	public function addExtractRequest(DataRequestInterface $dataRequest): ExchangeEngineInterface
	{
		$this->dataRequests[] = $dataRequest;
		return $this;
	}

	public function addTransformer(TransformInterface $transformer): ExchangeEngineInterface
	{
		$this->transformers[] = $transformer;
		return $this;
	}

	public function run(): void
	{
		// TODO: Implement run() method.
	}

	public function onExchangeProcess(ExchangeOnProcessEvent $event)
	{

	}

	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * @param ProviderInterface $provider
	 * @return ExchangeEngine
	 */
	public function setLoadProvider(ProviderInterface $provider): ExchangeEngineInterface
	{
		$this->loadProvider = $provider;
		return $this;
	}

	/**
	 * @param ProviderInterface $provider
	 * @return ExchangeEngine
	 */
	public function setExtractProvider(ProviderInterface $provider): ExchangeEngineInterface
	{
		$this->extractProvider = $provider;
		return $this;
	}


	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return [
			self::FIELD_CODE => $this->getCode(),

			self::FIELD_EXTRACTORS => $this->dataRequests,
			self::FIELD_LOADER => $this->loadRequest,
			self::FIELD_TRANSFORMERS => $this->transformers
		];
	}
}