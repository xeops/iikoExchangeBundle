<?php


namespace iikoExchangeBundle\Library\base\Config\Types;


class SelectConfigItem extends AbstractConfigItem
{

	public function getType(): string
	{
		return self::TYPE_SELECT;
	}

	/** @var string */
	protected $optionSetCode;



	public function setOptionSetCode(string $code): self
	{
		$this->optionSetCode = $code;
		return $this;
	}

	public function jsonSerialize()
	{
		$data = parent::jsonSerialize();

		$data['optionSetCode'] = $this->optionSetCode;

		return $data;
	}
}