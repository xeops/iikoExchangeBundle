<?php

namespace xeops\iikoExchange\Drivers\iiko\Reports;

use IikoApiBundle\Reports\iikoReportRequestDto as Dto;
use IikoApiBundle\Request\ServerApi2Request;
use iikoExchangeBundle\iikoExchangeBundle\Contract\RequestInterface;

class iikoReportRequest extends ServerApi2Request implements RequestInterface
{

	/** @var Dto */
	protected $dto;
	protected $url = 'reports/olap';
	protected $asAssocArr = false;

	public function setDto(Dto $dto)
	{
		$this->dto = $dto;
	}

	/**
	 * @param bool $asAssocArr
	 * @return iikoReportRequest
	 */
	public function setAsAssocArr(bool $asAssocArr): iikoReportRequest
	{
		$this->asAssocArr = $asAssocArr;
		return $this;
	}



	/**
	 * @return iikoReportRequestDto
	 */
	public function getDto()
	{
		return $this->dto;
	}

	/**
	 * requestParams function.
	 *
	 * @access protected
	 * @return string
	 */
	protected function requestParams()
	{
		if (!$this->dto) {
			throw new \Exception('DTO object for report request has not been set!');
		}
		return $this->dto->body();

	}

	protected function processResponse($response)
	{
		return json_decode($response, $this->asAssocArr);
	}

}
