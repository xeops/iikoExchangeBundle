<?php


namespace iikoExchangeBundle\Library\base\Request;


use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Contract\DataRequest\UploadDataRequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractUploadDataRequest extends AbstractDataRequest implements UploadDataRequestInterface
{


	protected array $requests = [];

	/** @var mixed */
	protected $data;

	public function processResponse($body)
	{
		return $body;
	}

	public function processError(ResponseInterface $response)
	{
		//void
	}

	public function withData($data): DataRequestInterface
	{
		$new = clone $this;
		$new->data = $data;

		return $new;
	}

	public function addDownloadRequest(DataRequestInterface $dataRequest): DataRequestInterface
	{
		$this->requests[$dataRequest->getCode()] = clone $dataRequest;
		return $this;
	}

	public function getDownloadRequests(): array
	{
		return $this->requests;
	}

	public function jsonSerialize()
	{
		return parent::jsonSerialize() + [self::FIELD_REQUESTS => array_values($this->getDownloadRequests())];
	}
}