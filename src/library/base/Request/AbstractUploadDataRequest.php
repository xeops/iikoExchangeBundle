<?php


namespace iikoExchangeBundle\Library\base\Request;


use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Contract\DataRequest\UploadDataRequestInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractUploadDataRequest extends AbstractDataRequest implements UploadDataRequestInterface
{
	protected array $requests = [];

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

	public function setRequestCodes(array $requestCodes): DataRequestInterface
	{
		$this->requests = $requestCodes;
	}

	public function isSupportRequestCode(string $requestCode): bool
	{
		return in_array($requestCode, $this->requests);
	}
}