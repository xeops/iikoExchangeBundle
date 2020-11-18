<?php


namespace iikoExchangeBundle\Library\base\Mapping;


use iikoExchangeBundle\Contract\Mapping\MappingCollectionItemInterface;
use iikoExchangeBundle\Contract\Mapping\MappingItemInterface;
use iikoExchangeBundle\Exception\MappingRowNotFoundException;

class MappingCollectionList
{
	protected string $mappingCode;
	/**
	 * @var MappingCollectionItemInterface[]
	 */
	protected array $data;

	public function setCollection(array $collection)
	{
		$this->data = $collection;
	}

	public function getListByIdentifiers(array $identifierKeys): ?array
	{
		foreach ($this->data as $item)
		{
			if ($this->getIdentifyKey($item->getIdentifiers()) === $this->getIdentifyKey($identifierKeys))
			{
				return $item->getValues();
			}
		}
		throw (new MappingRowNotFoundException())->setIdentifiers($identifierKeys)->setMappingCode($this->mappingCode);
	}

	public function getValueByIdentifiers(array $identifierKeys, string $valueCode)
	{
		return $this->getValueByCode($valueCode, $this->getListByIdentifiers($identifierKeys) ?? []);
	}

	/**
	 * @param string $searchCode
	 * @param MappingItemInterface[] $values
	 * @return MappingItemInterface|null
	 */
	protected function getValueByCode(string $searchCode, array $values)
	{
		foreach ($values as $code => $value)
		{
			if ($code === $searchCode)
			{
				return $value;
			}
		}
	}

	protected function getIdentifyKey(array $keys)
	{
		array_walk($keys, fn(&$key) => $key = strval($key));

		sort($keys); // to equals of search items order

		return implode("@", $keys);
	}

	/**
	 * @param string $mappingCode
	 * @return MappingCollectionList
	 */
	public function setMappingCode(string $mappingCode): MappingCollectionList
	{
		$this->mappingCode = $mappingCode;
		return $this;
	}


}