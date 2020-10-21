<?php


namespace iikoExchangeBundle\Library\base\Mapping;


use iikoExchangeBundle\Contract\Mapping\MappingItemInterface;

class MappingItem implements MappingItemInterface
{
	protected string $code;
	protected string $id;
	protected string $value;
	protected array $properties;

	/**
	 * @return string
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * @param string $code
	 */
	public function setCode(string $code): void
	{
		$this->code = $code;
	}

	/**
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * @param string $id
	 */
	public function setId(string $id): void
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}

	/**
	 * @param string $value
	 */
	public function setValue(string $value): void
	{
		$this->value = $value;
	}

	/**
	 * @return array
	 */
	public function getProperties(): array
	{
		return $this->properties;
	}

	/**
	 * @param array $properties
	 */
	public function setProperties(array $properties): void
	{
		$this->properties = $properties;
	}


}