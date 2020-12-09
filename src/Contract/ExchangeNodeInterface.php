<?php


namespace iikoExchangeBundle\Contract;


interface ExchangeNodeInterface
{
	const FIELD_CODE = 'code';

	public function getCode(): string;
}