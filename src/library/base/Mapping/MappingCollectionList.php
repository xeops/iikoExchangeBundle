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

	public function getListByIdentifiers(array $identifierKeys): ?array
	{
		foreach ($this->data as $item)
		{
			if ($this->getIdentifyKey($item->getIdentifiers()) === $this->getIdentifyKey($identifierKeys))
			{
				return $item->getValues();
			}
		}
		return null;
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

		return null;
	}

	protected function getIdentifyKey(array $keys)
	{
		sort($keys); // to equals of search items order

		return md5(implode("", array_map(fn(string $key) => md5($key), $keys)));
	}
}