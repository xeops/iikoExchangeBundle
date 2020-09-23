<?php


namespace iikoExchangeBundle\Contract;


interface ExchangeBuilderInterface
{
	public function setDownloadProvider(DownloadProviderInterface $provider);

	public function setUploadProvider(UploadProviderInterface $provider);

	public function setAdapter(AdapterInterface $adapter);

	public function addDataRequest(DataRequestInterface $request);
}