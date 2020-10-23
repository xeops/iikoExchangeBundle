<?php


namespace iikoExchangeBundle\Library\iiko\Request;


use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use iikoExchangeBundle\Library\base\Request\AbstractDataRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractOlapDataRequest extends AbstractDataRequest
{
	const TYPE_SALES = 'SALES';
	const TYPE_TRANSACTIONS = 'TRANSACTIONS';

	protected $groupFields = [];

	protected $aggregateFields = [];

	protected $filterFields = [];

	abstract protected function getOlapType(): string;

	public function getRequest(): RequestInterface
	{
		return new Request("POST", new Uri("/resto/api/v2/reports/olap"), [],
			json_encode([
				"reportType" => $this->getOlapType(),
				"buildSummary" => false,
				"filters" => $this->filterFields,
				"groupByRowFields" => $this->groupFields,
				"aggregateFields" => $this->aggregateFields
			]));
	}

	public function processError(ResponseInterface $response)
	{

	}

	public function setGroupField($field)
	{
		$this->groupFields = (array)$field;
		return $this;
	}

	public function setAggregateField($field)
	{
		$this->aggregateFields = (array)$field;
		return $this;
	}

	public function addFilter($field, $filter)
	{
		$this->filterFields[$field] = $filter;
	}

	public function processResponse($body)
	{
		return json_decode($body, true)['data'] ?? [];
	}
}