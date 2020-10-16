<?php


namespace iikoExchangeBundle\Library\base\Config\Types;


use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;

class MappingConfigItem extends AbstractConfigItem
{
	const FIELD_MAPPING_LIST = '_mappingList';

	protected array $mappingItems;


	public function getType(): string
	{
		return self::TYPE_MAPPING;
	}

	public function addMappingItem($code, ConfigItemInterface $configItem): self
	{
		$this->mappingItems[$code] = $configItem;

		return $this;
	}

	public function jsonSerialize()
	{
		return parent::jsonSerialize() + [self::FIELD_MAPPING_LIST => $this->mappingItems];
	}

	public function setValue($value)
	{
		if (is_string($value))
		{
			$this->value = json_decode($value, true);
		}
		else
		{
			$this->value = $value;
		}

		return $this;
	}
}