<?php


namespace iikoExchangeBundle\Library\base\Request;

use GuzzleHttp\Psr7\Header;
use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Library\Traits\ConfigurableTrait;

abstract class AbstractDataRequest implements DataRequestInterface
{
	protected array $children = [];

	use ConfigurableTrait;

	public function jsonSerialize()
	{
		return [
			self::FIELD_CODE => $this->getCode(),
			self::FIELD_CONFIGURATION => $this->getConfiguration()
		];
	}

	public function getTimeOut(): int
	{
		return 30;
	}

	public function getHeaders(): array
	{
		return [
			'Content-Type' => 'application/json',
			'Accept-Encoding' => "gzip"
		];
	}

	public function addChild(DataRequestInterface $request)
	{
		$this->children[$request->getCode()] = $request;
	}

	public function getChildren(): array
	{
		return $this->children;
	}
}