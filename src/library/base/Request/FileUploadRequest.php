<?php


namespace iikoExchangeBundle\Library\base\Request;


use GuzzleHttp\Psr7\Query;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Library\base\Config\Types\StringConfigItem;
use Psr\Http\Message\RequestInterface;

class FileUploadRequest extends AbstractUploadDataRequest
{

	protected string $fileName;
	protected $file;

	const CONFIG_PATH = 'PATH';


	protected string $code = "FTP_UPLOAD";

	/**
	 * @param string $code
	 */
	public function setCode(string $code): void
	{
		$this->code = $code;
	}

	public function getCode(): string
	{
		return $this->code;
	}

	public function getRequest(): RequestInterface
	{

		$uri = (new Uri())->withPath($this->getConfigValue(static::CONFIG_PATH));
		$uri = Uri::withQueryValue($uri, 'filename', $this->fileName);

		return new Request("POST", $uri, $this->getHeaders(), json_encode($this->data));
	}

	protected function createConfig(): array
	{
		return [... parent::createConfig(), new StringConfigItem(self::CONFIG_PATH)];
	}

	/**
	 * @param string $fileName
	 * @return FileUploadRequest
	 */
	public function withFileName(string $fileName)
	{
		$new = clone $this;
		$new->fileName = $fileName;

		return $new;
	}

	public function withData($data): DataRequestInterface
	{
		$new = clone $this;
		$handle = fopen('php://temp', 'w+');

		foreach ((array)$data as $datum)
		{
			fputs($handle, $datum);
		}
		rewind($handle);

		$new->file = $handle;

		return $new;
	}

	/**
	 * @return mixed
	 */
	public function getFile()
	{
		return $this->file;
	}


}