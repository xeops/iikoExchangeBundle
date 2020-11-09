<?php


namespace iikoExchangeBundle\Library\base\Exchange;


use iikoExchangeBundle\Contract\AdapterInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Contract\DataRequest\UploadDataRequestInterface;
use iikoExchangeBundle\Contract\ExchangeBuildDirectoryEventInterface;
use iikoExchangeBundle\Contract\ExchangeInterface;
use iikoExchangeBundle\Contract\ProviderInterface;
use iikoExchangeBundle\Contract\Schedule\ScheduleInterface;
use iikoExchangeBundle\Library\base\Schedule\ManualSchedule;
use iikoExchangeBundle\Library\Traits\ConfigurableTrait;
use Psr\Http\Message\RequestInterface;

class Exchange implements ExchangeInterface
{
	use ConfigurableTrait;

	/** @var ProviderInterface */
	protected ProviderInterface $downloadProvider;
	/** @var ProviderInterface */
	protected ProviderInterface $uploadProvider;

	/** @var AdapterInterface[] */
	protected array $adapters = [];
	/** @var ScheduleInterface[] */
	protected array $schedules = [];

	protected string $code;
	/**
	 * @var UploadDataRequestInterface[]
	 */
	protected array $uploaderRequests = [];

	public function __construct(string $code)
	{
		$this->code = $code;
	}

	public function setDownloadProvider(ProviderInterface $provider)
	{
		$this->downloadProvider = clone $provider;
		return $this;
	}

	public function setUploadProvider(ProviderInterface $provider)
	{
		$this->uploadProvider = clone $provider;
		return $this;
	}

	public function addAdapter(AdapterInterface $adapter)
	{
		$this->adapters[$adapter->getCode()] = clone $adapter;
		return $this;
	}


	public function register(ExchangeBuildDirectoryEventInterface $event)
	{
		$event->getDirectory()->registerExchange($this);
	}

	public function process()
	{
		foreach ($this->uploaderRequests as $uploaderRequest)
		{
			$result = null;

			foreach ($uploaderRequest->getDownloadRequests() as $dataRequest)
			{
				$data =  $this->downloadProvider->sendRequest($dataRequest);
				foreach ($this->adapters as $adapter)
				{
					if($adapter->isRequestAvailable($dataRequest))
					{
						$adapter->adapt($this, $dataRequest->getCode(), $data, $result);
					}
				}
			}
			$this->uploadProvider->sendRequest($uploaderRequest->withData($result));
		}
	}

	/**
	 * @return ProviderInterface
	 */
	public function getDownloadProvider(): ProviderInterface
	{
		return $this->downloadProvider;
	}

	/**
	 * @return ProviderInterface
	 */
	public function getUploadProvider(): ProviderInterface
	{
		return $this->uploadProvider;
	}

	/**
	 * @return DataRequestInterface[]
	 */
	public function getRequests(): array
	{
		$result = [];

		foreach ($this->uploaderRequests as $uploaderRequest)
		{
			$result[$uploaderRequest->getCode()] = $uploaderRequest;

			foreach ($uploaderRequest->getDownloadRequests() as $downloadRequest)
			{
				$result[$downloadRequest->getCode()] = $downloadRequest;
			}

		}
		return $result;
	}

	/**
	 * @return AdapterInterface[]
	 */
	public function getAdapters(): array
	{
		return $this->adapters;
	}

	public function jsonSerialize()
	{
		return [
			self::FIELD_CODE => $this->getCode(),
			self::FIELD_CONFIGURATION => $this->getConfiguration(),
			self::FIELD_PROVIDER => [
				self::FIELD_DOWNLOAD_PROVIDER => $this->downloadProvider,
				self::FIELD_UPLOAD_PROVIDER => $this->uploadProvider

			],
			self::FIELD_REQUEST => $this->getRequests(),
			self::FIELD_ADAPTER => $this->getAdapters(),
			self::FIELD_SCHEDULE => $this->getSchedules(),

		];
	}

	public function getSchedules(): array
	{
		$this->initManualScheduleAsDefault();
		return $this->schedules;
	}

	protected function initManualScheduleAsDefault()
	{
		$this->schedules = empty($this->schedules) ? [new ManualSchedule()] : $this->schedules;
	}

	public function addSchedule(ScheduleInterface $schedule)
	{
		$this->initManualScheduleAsDefault();
		$this->schedules[] = clone $schedule;
	}

	public function asTables()
	{
		return [];
	}

	/**
	 * @inheritDoc
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	public function addUploadRequest(UploadDataRequestInterface $dataRequest): ExchangeInterface
	{

		$this->uploaderRequests[$dataRequest->getCode()] = clone $dataRequest;

		return $this;
	}
}