<?php


namespace iikoExchangeBundle\Library\base\Config\Types;

use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;

abstract class AbstractConfigItem implements ConfigItemInterface
{
	protected string $code;
	protected $value;
	protected bool $required;
	protected string  $name;

	public function __construct(string $code, $default = null, bool $required = true)
	{
		$this->code = $code;
		$this->name = $code;
		$this->setValue($default);
		$this->required = $required;
	}

	public function getRequired(): bool
	{
		return $this->required;
	}

	public function getValue()
	{
		return $this->value;
	}

	public function jsonEncodeVale()
	{
		return $this->value;
	}

	public function setValue($value)
	{
		$this->value = $value;
	}

	public function getCode(): string
	{
		return $this->code;
	}

	public function getName(): string
	{
		return $this->name;
	}

	public function setName(string $name): ConfigItemInterface
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return [
			self::FIELD_CODE => $this->getCode(),
			self::FIELD_TYPE => $this->getType(),
			self::FIELD_NAME => $this->getName(),
			self::FIELD_VALUE => $this->jsonEncodeVale(),
			self::FIELD_REQUIRED => $this->getRequired()
		];
	}
}