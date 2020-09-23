<?php


namespace iikoExchangeBundle\Library\iiko\Reports\Olap;


class OlapSalesRequest extends OlapRequestBase
{

	public function getReportType(): string
	{
		return 'SALES';
	}
}