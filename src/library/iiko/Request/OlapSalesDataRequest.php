<?php


namespace iikoExchangeBundle\Library\iiko\Request;


use iikoExchangeBundle\Library\iiko\Reports\iikoReportFilter;
use iikoExchangeBundle\Library\iiko\Reports\Olap\Version52\Sales\FilterFields;

class OlapSalesDataRequest extends AbstractOlapDataRequest
{
	public function __construct()
	{
		$this->filterFields[FilterFields::OpenDateTyped] = iikoReportFilter::dateRange(new \DateTime(), new \DateTime(), true, false);
	}

	protected function getOlapType(): string
	{
		return self::TYPE_SALES;
	}
}