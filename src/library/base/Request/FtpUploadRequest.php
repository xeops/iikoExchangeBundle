<?php


namespace iikoExchangeBundle\Library\base\Request;


use GuzzleHttp\Psr7\Request;
use iikoExchangeBundle\Library\base\Config\Types\StringConfigItem;
use Psr\Http\Message\RequestInterface;

class FtpUploadRequest extends AbstractUploadDataRequest
{
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
		return new Request("POST", $this->getConfigValue(self::CONFIG_PATH), $this->getHeaders(), $this->data);
	}

	protected function createConfig(): array
	{
		return parent::createConfig() + [self::CONFIG_PATH => new StringConfigItem()];
	}
}