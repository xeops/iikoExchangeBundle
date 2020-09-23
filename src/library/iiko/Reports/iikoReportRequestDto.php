<?php

namespace iikoExchangeBundle\iikoReports;


class iikoReportRequestDto
{

	protected $reportType;
	protected $groups;
	protected $groupCols;
	protected $aggregates;
	protected $filters;

	const TYPE_SALES = "SALES",
		TYPE_TRANSACTIONS = "TRANSACTIONS";

	/**
	 * __construct function.
	 *
	 * @access public
	 * @param $type
	 */
	function __construct($type = self::TYPE_SALES)
	{
		$this->reportType = $type;
		$this->groups = array();
		$this->groupCols = array();
		$this->aggregates = array();
		$this->filters = array();
	}


	/**
	 * reportSales function.
	 *
	 * @access public
	 * @static
	 * @return iikoReportRequestDto
	 */
	public static function reportSales()
	{

		return new self(self::TYPE_SALES);

	}


	public static function reportTransactions()
	{
		return new self(self::TYPE_TRANSACTIONS);
	}


	/**
	 * addGroup function.
	 *
	 * @access public
	 * @return void
	 */
	public function addGroupField()
	{

		$n = func_num_args();
		if ($n == 0) return;

		$fields = func_get_args();

		foreach ($fields as $f) {
			$this->groups[] = $f;
		}


	}


	/**
	 * addGroupCol function.
	 *
	 * @access public
	 * @return void
	 */
	public function addGroupCol()
	{

		$n = func_num_args();
		if ($n == 0) return;

		$fields = func_get_args();

		foreach ($fields as $f) {
			$this->groupCols[] = $f;
		}


	}


	/**
	 * addValue function.
	 *
	 * @access public
	 * @return void
	 */
	public function addValueField()
	{

		$n = func_num_args();
		if ($n == 0) return;

		$fields = func_get_args();

		foreach ($fields as $f) {
			$this->aggregates[] = $f;
		}


	}


	/**
	 * addFilter function.
	 *
	 * @access public
	 * @param mixed $field
	 * @param mixed $filter
	 * @return $this
	 */
	public function addFilter($field, $filter)
	{

		$this->filters[$field] = $filter;
		return $this;

	}


	/**
	 * body function.
	 *
	 * @access public
	 * @return string
	 */
	public function body()
	{

		$arr = array(
			"reportType" => $this->reportType,
			"buildSummary" => false,
		);

		if ($this->filters) {
			$arr["filters"] = $this->filters;
		}

		if ($this->groups) {
			$arr["groupByRowFields"] = $this->groups;
		}


		if ($this->groupCols) {
			$arr["groupByColFields"] = $this->groupCols;
		}

		if ($this->aggregates) {
			$arr["aggregateFields"] = $this->aggregates;
		}


		return json_encode($arr);

	}

}
