<?php


namespace iikoExchangeBundle\Contract\DataRequest;


interface UploadDataRequestInterface extends DataRequestInterface
{
	public function withData($data): DataRequestInterface;

	public function setRequestCodes(array $requestCodes): DataRequestInterface;

	public function isSupportRequestCode(string $requestCode): bool;
}