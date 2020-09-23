<?php

namespace iikoExchangeBundle\iikoReports;

use IikoApiBundle\Model\Report\BalanceStoreItemDto;
use IikoApiBundle\Request\ServerApi2Request;

/**
 * Class iikoReportBalanceStores
 * @package IikoApiBundle\Reports
 */
class iikoReportBalanceStores extends ServerApi2Request
{

	protected $type = 'get';

	/** @var \DateTime|null */
	private $dateTime = null;
	private $departmentIds = [];
	private $products = [];
	private $storeIds = [];
	private $asDto = false;
	protected $url = "reports/balance/stores";

	public function __construct(\DateTime $st)
	{
		$this->dateTime = $st;
	}

	/**
	 * @param bool $asDto
	 * @return $this
	 */
	public function setAsDto(bool $asDto)
	{
		$this->asDto = $asDto;
		return $this;
	}

	/**
	 * @param array $departmentIds
	 * @return $this
	 */
	public function setDepartmentIds($departmentIds)
	{
		if (!is_array($departmentIds)) {
			$departmentIds = [$departmentIds];
		}
		$this->departmentIds = $departmentIds;
		return $this;
	}

	/**
	 * @param $productIds
	 * @return $this
	 */
	public function setProductsFilter($productIds)
	{
		if (!is_array($productIds)) {
			$productIds = [$productIds];
		}
		$this->products = $productIds;
		return $this;
	}


	/**
	 * @param $storeIds
	 * @return $this
	 */
	public function setStoreFilter($storeIds)
	{
		if (!is_array($storeIds)) {
			$storeIds = [$storeIds];
		}
		$this->storeIds = $storeIds;
		return $this;
	}


	/**
	 * @inheritdoc
	 */
	protected function processResponse($response)
	{
		if (!$this->asDto) {
			return json_decode($response);
		} else {
			$arr = json_decode($response, true);
			$res = [];
			foreach ($arr as $item) {
				$res[] = BalanceStoreItemDto::newFromArray($item);
			}
			return $res;
		}
	}

	protected function requestParams()
	{
		$arr = [];
		$arr['timestamp'] = $this->dateTime->format('Y-m-d\TH:i:s');
		if ($this->departmentIds) {
			$arr['department'] = $this->departmentIds;
		}
		if ($this->products) {
			$arr['product'] = $this->products;
		}
		if ($this->storeIds) {
			$arr['store'] = $this->storeIds;
		}
		return $arr;
	}
}
