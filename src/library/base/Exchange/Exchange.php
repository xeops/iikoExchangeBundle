<?php


namespace iikoExchangeBundle\Library\base\Exchange;


use iikoExchangeBundle\Contract\AdapterInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Contract\DataRequest\UploadDataRequestInterface;
use iikoExchangeBundle\Contract\ExchangeBuildDirectoryEventInterface;
use iikoExchangeBundle\Contract\ExchangeInterface;
use iikoExchangeBundle\Contract\PeriodicalInterface;
use iikoExchangeBundle\Contract\ProviderInterface;
use iikoExchangeBundle\Contract\Schedule\ScheduleInterface;
use iikoExchangeBundle\Contract\WithAccountInterface;
use iikoExchangeBundle\Contract\WithRestaurantInterface;
use iikoExchangeBundle\Exception\MappingRowNotFoundException;
use iikoExchangeBundle\Library\base\Request\FileUploadRequest;
use iikoExchangeBundle\Library\Traits\ConfigurableTrait;
use iikoExchangeBundle\Library\Traits\PeriodicalTrait;
use iikoExchangeBundle\Library\Traits\WithAccountTrait;
use iikoExchangeBundle\Library\Traits\WithRestaurantTrait;
use Psr\Http\Message\RequestInterface;

class Exchange implements ExchangeInterface, PeriodicalInterface, WithRestaurantInterface, WithAccountInterface
{
	use ConfigurableTrait;

	use PeriodicalTrait;

	use WithRestaurantTrait;

	use WithAccountTrait;

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

			if ($uploaderRequest instanceof PeriodicalInterface)
			{
				$uploaderRequest->setPeriod($this->getPeriod());
			}
			if ($uploaderRequest instanceof WithRestaurantInterface)
			{
				$uploaderRequest->setRestaurant($this->getRestaurant());
			}
			if ($uploaderRequest instanceof WithAccountInterface)
			{
				$uploaderRequest->setAccount($this->getAccount());
			}

			foreach ($uploaderRequest->getDownloadRequests() as $dataRequest)
			{
				if ($dataRequest instanceof PeriodicalInterface)
				{
					$dataRequest->setPeriod($this->getPeriod());
				}
				if ($dataRequest instanceof WithRestaurantInterface)
				{
					$dataRequest->setRestaurant($this->getRestaurant());
				}
				if ($dataRequest instanceof WithAccountInterface)
				{
					$dataRequest->setAccount($this->getAccount());
				}

				$data = $this->downloadProvider->sendRequest($dataRequest);
				foreach ($this->adapters as $adapter)
				{
					if ($adapter instanceof PeriodicalInterface)
					{
						$adapter->setPeriod($this->getPeriod());
					}
					if ($adapter instanceof WithRestaurantInterface)
					{
						$adapter->setRestaurant($this->getRestaurant());
					}
					if ($adapter instanceof WithAccountInterface)
					{
						$adapter->setAccount($this->getAccount());
					}

					if ($adapter->isRequestAvailable($dataRequest))
					{
						try
						{
							$adapter->adapt($this, $dataRequest->getCode(), $uploaderRequest, $data);

						} catch (MappingRowNotFoundException $exception)
						{
							throw  $exception->setExchangeCode($this->getCode())->setAdapterCode($adapter->getCode());
						}
					}
				}
			}
			if (!empty($uploaderRequest->getData()) || ($uploaderRequest instanceof FileUploadRequest && is_resource($uploaderRequest->getFile())))
			{
				$this->uploadProvider->sendRequest($uploaderRequest);
			}
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
		return $this->uploaderRequests;
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
			self::FIELD_REQUEST => array_values($this->getRequests()),
			self::FIELD_ADAPTER => array_values($this->getAdapters()),
			self::FIELD_SCHEDULE => array_values($this->getSchedules()),

		];
	}

	public function getSchedules(): array
	{
		$this->initManualScheduleAsDefault();
		return $this->schedules;
	}

	protected function initManualScheduleAsDefault()
	{
		$this->schedules = empty($this->schedules) ? [] : $this->schedules;
	}

	public function addSchedule(ScheduleInterface $schedule)
	{
		$this->initManualScheduleAsDefault();
		$this->schedules[] = clone $schedule;
	}

	public function asTables()
	{


		foreach ($this->uploaderRequests as $uploaderRequest)
		{
			$item = null;

			foreach ($uploaderRequest->getDownloadRequests() as $dataRequest)
			{
				$data = $this->downloadProvider->sendRequest($dataRequest);
				foreach ($this->adapters as $adapter)
				{
					if ($adapter->isRequestAvailable($dataRequest))
					{
						try
						{
							$adapter->adapt($this, $uploaderRequest, $data);
						} catch (MappingRowNotFoundException $exception)
						{
							throw $exception->setExchangeCode($this->getCode())->setAdapterCode($adapter->getCode());
						}
					}
				}
			}
			$result[$uploaderRequest->getCode()] = $item;
		}
		return $result;
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

		$this->uploaderRequests[] = clone $dataRequest;

		return $this;
	}
}