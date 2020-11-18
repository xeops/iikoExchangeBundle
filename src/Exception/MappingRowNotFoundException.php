<?php


namespace iikoExchangeBundle\Exception;


use Throwable;

class MappingRowNotFoundException extends \Exception
{
	protected array $identifiers = [];
	protected string $mappingCode;
	protected string $exchangeCode;
	protected string $adapterCode;

	public function __construct($message = "EXCHANGE_MAPPING_ROW_NOT_FOUND", $code = 500, Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

	/**
	 * @param array $identifiers
	 */
	public function setIdentifiers(array $identifiers): self
	{
		array_walk($identifiers, fn(&$item) => $item = is_null($item) ? 'null': $item);
		$this->identifiers = $identifiers;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getIdentifiers(): array
	{
		return $this->identifiers;
	}

	/**
	 * @return string
	 */
	public function getMappingCode(): string
	{
		return $this->mappingCode;
	}

	/**
	 * @param string $mappingCode
	 * @return MappingRowNotFoundException
	 */
	public function setMappingCode(string $mappingCode): MappingRowNotFoundException
	{
		$this->mappingCode = $mappingCode;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getExchangeCode(): string
	{
		return $this->exchangeCode;
	}

	/**
	 * @param string $exchangeCode
	 * @return MappingRowNotFoundException
	 */
	public function setExchangeCode(string $exchangeCode): MappingRowNotFoundException
	{
		$this->exchangeCode = $exchangeCode;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getAdapterCode(): string
	{
		return $this->adapterCode;
	}

	/**
	 * @param string $adapterCode
	 * @return MappingRowNotFoundException
	 */
	public function setAdapterCode(string $adapterCode): MappingRowNotFoundException
	{
		$this->adapterCode = $adapterCode;
		return $this;
	}


}