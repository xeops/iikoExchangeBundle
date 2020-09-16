<?php

namespace xeops\iikoExchange\Drivers\iiko\Reports;

use IikoApiBundle\Reports\iikoReportRequestDto as Dto;
use IikoApiBundle\Request\iikoApiRequest;
use IikoApiBundle\Request\ServerApi2Request as ApiTwoRequest;
use IikoApiBundle\Request\ServerApi2Request;

class iikoReportColumnsRequest extends ServerApi2Request
{

	const REPORT_SALES = "SALES";
	const REPORT_DELIVERY = "DELIVERIES";
	const REPORT_TRANSACTIONS = "TRANSACTIONS";

	protected $reportType;
	protected $type = 'get';
	protected $url = 'reports/olap/columns';


	function setReportType($type)
	{
		$this->reportType = $type;
	}

	/**
	 * requestParams function.
	 *
	 * @access protected
	 * @return array
	 */
	protected function requestParams()
	{
		return ["reportType" => $this->reportType];

	}

	protected function processResponse($response)
	{
		return json_decode($response);
	}

}
