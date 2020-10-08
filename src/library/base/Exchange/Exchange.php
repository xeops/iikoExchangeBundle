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
	protected $downloadProvider;
	/** @var ProviderInterface */
	protected $uploadProvider;
	/** @var DataRequestInterface[] */
	protected $requests = [];
	/** @var AdapterInterface */
	protected $adapter;

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

	public function setAdapter(AdapterInterface $adapter)
	{
		$this->adapter = $adapter;

		return $this;
	}

	public function addDataRequest(DataRequestInterface $request)
	{
		$this->requests[$request->getCode()] = $request;

		return $this;
	}

	abstract public function getCode(): string;

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
	 * @return AdapterInterface
	 */
	public function getAdapter(): AdapterInterface
	{
		return $this->adapter;
	}
}