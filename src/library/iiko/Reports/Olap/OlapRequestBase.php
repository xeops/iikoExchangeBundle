<?php


namespace iikoExchangeBundle\Library\iiko\Reports\Olap;


use iikoExchangeBundle\Contract\RequestInterface;
use iikoExchangeBundle\Contract\ResponseInterface;

abstract class OlapRequestBase implements RequestInterface
{
	/**
	 * @return string
	 */
	abstract public function getReportType(): string;

	/**
	 * @var bool
	 */
	private $buildSummary = false;
	/**
	 * @var string[]
	 */
	protected $groupByRowFields = [];

	/**
	 * @var string[]
	 */
	protected $aggregateFields;

	/**
	 * @var array[]
	 */
	protected $filters;

	public $timeOut = 30;

	public function getUri()
	{
		return '/resto/api/v2/reports/olap';
	}

	public function getMethod()
	{
		return "POST";
	}

	public function getHeaders()
	{
		return [
			'Content-Type' => 'application/json'
		];
	}

	public function getBody()
	{
		return [

			"reportType" => $this->getReportType(),
			"buildSummary" => $this->buildSummary,
			"groupByRowFields" => (array)$this->groupByRowFields,
			"aggregateFields" => (array)$this->aggregateFields,
			"filters" => (array)$this->filters
		];
	}

	public function processResponse(): ResponseInterface
	{
		// TODO: Implement processResponse() method.
	}

	public function getTimeOut(): int
	{
		return intval($this->timeOut);
	}

	public function addGroup($group): RequestInterface
	{
		$this->groupByRowFields = array_merge($this->groupByRowFields, (array)$group);
		return $this;
	}

	public function addAggregate($aggregate): RequestInterface
	{
		$this->aggregateFields = array_merge($this->aggregateFields, (array)$aggregate);
		return $this;
	}

	public function addFilter($field, $filter)
	{
		$this->filters[$field] = $filter;
		return $this;
	}

	public function setGroup($group)
	{
		$this->groupByRowFields = (array)$group;
		return $this;
	}

	public function setAggregate($aggregate)
	{
		$this->aggregateFields = (array)$aggregate;
		return $this;
	}

	public function setFilters(array $filters)
	{
		$this->filters = $filters;
		return $this;
	}
}