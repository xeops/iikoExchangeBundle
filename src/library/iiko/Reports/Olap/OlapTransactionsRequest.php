<?php


namespace iikoExchangeBundle\Library\iiko\Reports\Olap;


class OlapTransactionsRequest extends OlapRequestBase
{

	public function getReportType(): string
	{
		return 'TRANSACTIONS';
	}
}