<?php


namespace iikoExchangeBundle\Contract;


interface ExchangeBuilderInterface
{
	public function setDownloadProvider(DataDownloadDriverInterface $provider);

	public function setUploadProvider(DataUploadDriverInterface $provider);

	public function setAdapter(AdapterInterface $adapter);

	public function addDataRequest(DataDownloadRequestInterface $request);
}