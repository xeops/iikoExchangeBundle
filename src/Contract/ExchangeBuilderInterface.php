<?php


namespace iikoExchangeBundle\Contract;


use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;

interface ExchangeBuilderInterface
{
	// SET

	public function setDownloadProvider(ProviderInterface $provider);

	public function setUploadProvider(ProviderInterface $provider);

	public function addAdapter(AdapterInterface $adapter);

	public function addDataRequest(DataRequestInterface $request);

	// GET

	public function getDownloadProvider() : ProviderInterface;

	public function getUploadProvider() : ProviderInterface;

	/**
	 * @return AdapterInterface[]
	 */
	public function getAdapters() : array;

	/**
	 * @return DataRequestInterface[]
	 */
	public function getRequests() : array;
}