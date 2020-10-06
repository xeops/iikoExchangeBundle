<?php


namespace iikoExchangeBundle\Contract;


interface ConfigItemInterface extends \JsonSerializable
{
	public function __construct($value = null);

	const TYPE_STRING = 'string';
	const TYPE_INT = 'int';
	const TYPE_FLOAT = 'float';
	const TYPE_DATE_DIFF = 'date_diff';
	const TYPE_SELECT = 'array';
	const TYPE_PASSWORD = 'password';

	public function getCode() : string;

	public function getType() : string;

	public function getValue();

	public function normalize();

	public function setValue($value);
}