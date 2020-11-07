<?php


namespace iikoExchangeBundle\Contract\DataRequest;


interface UploadDataRequestInterface extends DataRequestInterface
{
	public function withData($data): DataRequestInterface;

	public function addDownloadRequest(DataRequestInterface $dataRequest): DataRequestInterface;

	/**
	 * @return DataRequestInterface[]
	 */
	public function getDownloadRequests() : array;
}