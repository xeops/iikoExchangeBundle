<?php


namespace iikoExchangeBundle\Contract;


interface ExchangeBuilderInterface
{
	public function setDownloadProvider(ProviderInterface $provider);

	public function setUploadProvider(ProviderInterface $provider);

	public function setAdapter(AdapterInterface $adapter);

	public function addDataRequest(DataDownloadRequestInterface $request);
}