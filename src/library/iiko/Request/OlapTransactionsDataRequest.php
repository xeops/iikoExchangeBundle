<?php


namespace iikoExchangeBundle\Library\iiko\Request;


class OlapTransactionsDataRequest extends AbstractOlapDataRequest
{

	protected function getOlapType(): string
	{
		return self::TYPE_TRANSACTIONS;
	}
}