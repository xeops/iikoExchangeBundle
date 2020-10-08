<?php


namespace iikoExchangeBundle\Contract\Mapping;


interface MappingInterface
{
	public function getCode();

	public function getRequestDataCode();

	public function getExchangeDataCode();

	public function fillMapping($data);

	public function getExchangeDataByRequestData($data);
}