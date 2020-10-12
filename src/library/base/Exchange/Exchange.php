<?php


namespace iikoExchangeBundle\Library\base\Exchange;


use iikoExchangeBundle\Contract\AdapterInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Contract\ExchangeBuildDirectoryEventInterface;
use iikoExchangeBundle\Contract\ExchangeInterface;
use iikoExchangeBundle\Contract\ProviderInterface;
use Psr\Http\Message\RequestInterface;

abstract class Exchange implements ExchangeInterface
{
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


	public function register(ExchangeBuildDirectoryEventInterface  $event)
	{
		$event->getDirectory()->registerExchange($this);
	}

	public function process()
	{
		$data = [];

		foreach ($this->requests as $request)
		{
			$data[$request->getCode()] = $this->downloadProvider->sendRequest($request->getRequest());
		}
		/** @var RequestInterface $data */
		$data = $this->adapter->adapt($data);
		if(!($data instanceof RequestInterface))
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
			'code' => $this->getCode(),
			'config' => $this->getConfig(),
			'requests' => $this->getRequests(),
			'adapters' => $this->getAdapters()
		];
	}

	public function getConfig(): array
	{
		return [];
	}
}