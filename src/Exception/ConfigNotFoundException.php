<?php


namespace iikoExchangeBundle\Exception;


use Throwable;

class ConfigNotFoundException extends \Exception
{
	protected string $nodeCode;
	protected string $configCode;

	public function __construct($message = "EXCHANGE_CONFIG_VALUE_NOT_FOUND", $code = 500, Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

	/**
	 * @return string
	 */
	public function getNodeCode(): string
	{
		return $this->nodeCode;
	}

	/**
	 * @param string $nodeCode
	 * @return ConfigNotFoundException
	 */
	public function setNodeCode(string $nodeCode): ConfigNotFoundException
	{
		$this->nodeCode = $nodeCode;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getConfigCode(): string
	{
		return $this->configCode;
	}

	/**
	 * @param string $configCode
	 * @return ConfigNotFoundException
	 */
	public function setConfigCode(string $configCode): ConfigNotFoundException
	{
		$this->configCode = $configCode;
		return $this;
	}


}