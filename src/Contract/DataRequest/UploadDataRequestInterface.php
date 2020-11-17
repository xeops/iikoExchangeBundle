<?php


namespace iikoExchangeBundle\Contract\DataRequest;


interface UploadDataRequestInterface extends DataRequestInterface
{
	const FIELD_REQUESTS = 'downloads';

	public function withData($data): DataRequestInterface;

	public function addDownloadRequest(DataRequestInterface $dataRequest): DataRequestInterface;

	/**
	 * @return DataRequestInterface[]
	 */
	public function getDownloadRequests() : array;
}