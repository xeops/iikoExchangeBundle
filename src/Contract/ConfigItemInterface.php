<?php


namespace iikoExchangeBundle\Contract;


interface ConfigItemInterface extends \JsonSerializable
{
	public function getName();

	public function getCode();

	public function getType();

	public function getDefaultValue();

	public function getDescription();

}