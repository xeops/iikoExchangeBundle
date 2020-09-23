<?php


namespace iikoExchangeBundle\Library\iiko\Request;

use iikoExchangeBundle\Contract\DataSourceDriverInterface;
use iikoExchangeBundle\Contract\ProviderInterface;
use iikoExchangeBundle\Contract\RequestInterface;
use iikoExchangeBundle\Contract\ResponseInterface;
use iikoExchangeBundle\Library\iiko\Reports\iikoReportFilter;
use iikoExchangeBundle\Library\iiko\Reports\Olap\OlapSalesRequest;
use iikoExchangeBundle\Library\iiko\Reports\Olap\Version52\Sales\AggregateFields;
use iikoExchangeBundle\Library\iiko\Reports\Olap\Version52\Sales\GroupFields;
use Psr\Log\LoggerInterface;

class iikoSalesRequest implements RequestInterface
{
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	/**
	 * @var ProviderInterface
	 */
	private $provider;

	public function __construct(LoggerInterface $logger, ProviderInterface $provider)
	{

		$this->logger = $logger;
		$this->provider = $provider;
	}

	public function load(?RequestInterface $request = null): ResponseInterface
	{
		return $this->provider->sendRequest($request ?? static::getBaseRequest());
	}

	public static function getBaseRequest(): RequestInterface
	{
		return
			(new OlapSalesRequest())

				->setAggregate([
					AggregateFields::DishSumInt,
					AggregateFields::VATSum,
					AggregateFields::DishDiscountSumInt
				])

				->setGroup([
					GroupFields::OpenDateTyped,
					GroupFields::DepartmentId,
					GroupFields::DishTaxCategoryId,
					GroupFields::OrderType,
					GroupFields::UniqOrderIdId
				])

				->addFilter(GroupFields::OpenDateTyped, iikoReportFilter::datePeriod())
				->addFilter(GroupFields::Storned, iikoReportFilter::valueList(array('TRUE'), iikoReportFilter::VALUE_LIST_EXCLUDE))
				->addFilter(GroupFields::OrderDeleted, iikoReportFilter::valueList(array('DELETED'), iikoReportFilter::VALUE_LIST_EXCLUDE))
				->addFilter(GroupFields::DeletedWithWriteoff, iikoReportFilter::valueList(array('NOT_DELETED'), iikoReportFilter::VALUE_LIST_INCLUDE));
	}

	public function getUri()
	{
		// TODO: Implement getUri() method.
	}

	public function getMethod()
	{
		// TODO: Implement getMethod() method.
	}

	public function getHeaders()
	{
		// TODO: Implement getHeaders() method.
	}

	public function getBody()
	{
		// TODO: Implement getBody() method.
	}

	public function processResponse(): ResponseInterface
	{
		// TODO: Implement processResponse() method.
	}

	public function getTimeOut(): int
	{
		// TODO: Implement getTimeOut() method.
	}
}