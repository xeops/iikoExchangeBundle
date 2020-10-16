<?php


namespace iikoExchangeBundle\Library\base\Exchange;


use iikoExchangeBundle\Contract\AdapterInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Contract\ExchangeBuildDirectoryEventInterface;
use iikoExchangeBundle\Contract\ExchangeInterface;
use iikoExchangeBundle\Contract\ProviderInterface;
use iikoExchangeBundle\Contract\Schedule\ScheduleInterface;
use iikoExchangeBundle\Library\base\Schedule\ManualSchedule;
use iikoExchangeBundle\Library\Traits\ConfigurableTrait;
use Psr\Http\Message\RequestInterface;

abstract class Exchange implements ExchangeInterface
{
	use ConfigurableTrait;

	/**
	 * @var ProviderInterface
	 */
	protected ProviderInterface $downloadProvider;
	/** @var ProviderInterface */
	protected ProviderInterface $uploadProvider;
	/** @var DataRequestInterface[] */
	protected array $requests = [];
	/** @var AdapterInterface[] */
	protected array $adapters;
	/** @var ScheduleInterface[] */
	protected array $schedules = [];

	public function setDownloadProvider(ProviderInterface $provider)
	{
		$this->downloadProvider = $provider;

		return $this;
	}

	public function setUploadProvider(ProviderInterface $provider)
	{
		$this->uploadProvider = $provider;

		return $this;
	}

	public function addAdapter(AdapterInterface $adapter)
	{
		$this->adapters[$adapter->getCode()] = $adapter;

		return $this;
	}

	public function addDataRequest(DataRequestInterface $request)
	{
		$this->requests[$request->getCode()] = $request;

		return $this;
	}


	public function register(ExchangeBuildDirectoryEventInterface $event)
	{
		$event->getDirectory()->registerExchange($this);
	}

	public function process()
	{
		$data = [];

		foreach ($this->requests as $request)
		{
			$data[$request->getCode()] = $this->downloadProvider->sendRequest($request);
		}

		/** @var RequestInterface $data */
		$data = $this->adapter->adapt($data);
		if (!($data instanceof RequestInterface))
		{
			throw new \Exception('Adapter must return RequestInterface to direct send to upload endpoint');
		}
		return $this->uploadProvider->sendRequest($data);

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
		return $this->requests;
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
		$this->schedules[] = $schedule;
	}

	public function asTables()
	{
		return [];
	}
}