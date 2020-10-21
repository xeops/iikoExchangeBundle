<?php


namespace iikoExchangeBundle\Library\base\Mapping;


use iikoExchangeBundle\Contract\Mapping\MappingCollectionItemInterface;

class MappingCollectionItem  implements MappingCollectionItemInterface
{
	/**
	 * @var string[]
	 */
	protected array $identifiers;

	protected array $values;

	/**
	 * @return array
	 */
	public function getIdentifiers(): array
	{
		return $this->identifiers;
	}

	/**
	 * @param array $identifiers
	 */
	public function setIdentifiers(array $identifiers): void
	{
		$this->identifiers = $identifiers;
	}

	/**
	 * @return array
	 */
	public function getValues(): array
	{
		return $this->values;
	}

	/**
	 * @param array $values
	 */
	public function setValues(array $values): void
	{
		$this->values = $values;
	}


}