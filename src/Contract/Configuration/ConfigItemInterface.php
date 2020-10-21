<?php


namespace iikoExchangeBundle\Contract\Configuration;


interface ConfigItemInterface extends \JsonSerializable
{
	public function __construct($default = null, bool $required = true);

	const TYPE_STRING = 'string';
	const TYPE_URL = 'url';
	const TYPE_INT = 'int';
	const TYPE_FLOAT = 'float';
	const TYPE_DATE_DIFF = 'date_diff';
	const TYPE_SELECT = 'select';
	const TYPE_PASSWORD = 'password';
	const TYPE_MAPPING = 'mapping';
	const TYPE_PERIOD = 'period';


	const FIELD_TYPE = '_type';
	const FIELD_VALUE = '_value';
	const FIELD_REQUIRED = '_required';

	public function getType() : string;

	public function getValue();

	public function jsonEncodeVale();

	public function setValue($value);

	public function getRequired() : bool;
}