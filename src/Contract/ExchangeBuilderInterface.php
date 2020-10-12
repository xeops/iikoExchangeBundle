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

	public function getAdapters() : array;

	public function getRequests() : array;
}