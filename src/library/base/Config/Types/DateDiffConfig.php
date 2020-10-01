<?php


namespace iikoExchangeBundle\Library\base\Config\Types;


use iikoExchangeBundle\Contract\ConfigItemInterface;

class DateDiffConfig implements ConfigItemInterface
{
	protected $value = '-1 day';
	protected $code;
	public function __construct($value = null)
	{
		$this->value = $value ?? $this->value;

	}

	public function getCode(): string
	{
		return "DATE_DIFF";
	}

	public function getType(): string
	{
		return self::TYPE_DATE_DIFF;
	}


	/**
	 * @inheritDoc
	 * @return \DateTime
	 */
	public function normalize()
	{
		return new \DateTime($this->getValue());
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return $this->getValue();
	}

	/**
	 * @inheritDoc
	 * @return string
	 */
	public function getValue()
	{
		return strval($this->value);
	}

	public function setValue($value)
	{
		$this->value = strval($value);
		return $this;
	}


}