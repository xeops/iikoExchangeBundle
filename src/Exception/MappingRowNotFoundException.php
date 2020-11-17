<?php


namespace iikoExchangeBundle\Exception;


use Throwable;

class MappingRowNotFoundException extends \Exception
{
	protected array $identifiers = [];

	public function __construct($message = "EXCHANGE_MAPPING_ROW_NOT_FOUND", $code = 500, Throwable $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

	/**
	 * @param array $identifiers
	 */
	public function setIdentifiers(array $identifiers): self
	{
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
}