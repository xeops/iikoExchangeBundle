<?php


namespace iikoExchangeBundle\Contract;


interface ExchangeBuilderInterface
{
	// SET

	public function setDownloadProvider(ProviderInterface $provider);

	public function setUploadProvider(ProviderInterface $provider);

	public function setAdapter(AdapterInterface $adapter);

	public function addDataRequest(DataRequestInterface $request);

	// GET

	public function getDownloadProvider() : ProviderInterface;

	public function getUploadProvider() : ProviderInterface;

	public function getAdapter() : AdapterInterface;

	public function getRequests() : array;
}