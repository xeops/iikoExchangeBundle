<?php


namespace iikoExchangeBundle\Library\base\Mapping;


use iikoExchangeBundle\Contract\Mapping\MappingCollectionItemInterface;
use iikoExchangeBundle\Contract\Mapping\MappingItemInterface;

class MappingCollectionList
{
	/**
	 * @var MappingCollectionItemInterface[]
	 */
	protected array $data;

	public function setCollection(array $collection)
	{
		$this->data = $collection;
	}

	public function getByIdentifiers($identifierKeys, ?string $valueCode = null)
	{
		foreach ($this->data as $item)
		{
			if ($this->getIdentifyKey($item->getIdentifiers()) === $this->getIdentifyKey($identifierKeys))
			{
				return $valueCode ? $this->getValueByCode($valueCode, $item->getValues()) : $item->getValues();
			}
		}
		$identify = $this->getIdentifyKey($identifierKeys);

		return $this->data[$identify];
	}

	/**
	 * @param string $searchCode
	 * @param MappingItemInterface[] $values
	 * @return MappingItemInterface
	 */
	protected function getValueByCode(string $searchCode, array $values): MappingItemInterface
	{
		foreach ($values as $value)
		{
			if ($value->getCode() === $searchCode)
			{
				return $value;
			}
		}
	}

	protected function getIdentifyKey(array $keys)
	{
		sort($keys); // to equals of search items order

		return md5(implode("", array_map(fn(string $key) => md5($key), $keys)));
	}
}