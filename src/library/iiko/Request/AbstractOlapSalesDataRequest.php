<?php

namespace iikoExchangeBundle\Library\iiko\Request;

use iikoExchangeBundle\Contract\PeriodicalInterface;
use iikoExchangeBundle\Library\base\Config\Types\IntConfigItem;
use iikoExchangeBundle\Library\iiko\Reports\iikoReportFilter;
use iikoExchangeBundle\Library\iiko\Reports\Olap\Sales\FilterFields;
use iikoExchangeBundle\Library\Traits\PeriodicalTrait;
use Psr\Http\Message\RequestInterface;

abstract class AbstractOlapSalesDataRequest extends AbstractOlapDataRequest implements PeriodicalInterface
{
	use PeriodicalTrait;

	const CONFIG_DATE_DAYS = 'DATE_DAYS';
	const CONFIG_DATE_DIFF = 'DATE_DIFF';


	protected function getOlapType(): string
	{
		return self::TYPE_SALES;
	}

	public function getRequest(): RequestInterface
	{
		$this->filterFields[FilterFields::OpenDateTyped] = iikoReportFilter::dateRange($this->getPeriod()->getStartDate()->getTimestamp(), $this->getPeriod()->getEndDate()->getTimestamp(), true, true);
		return parent::getRequest(); // TODO: Change the autogenerated stub
	}

	public function createConfig(): array
	{
		return [
			new IntConfigItem(self::CONFIG_DATE_DIFF, 0),
			new IntConfigItem(self::CONFIG_DATE_DAYS, 0)
		];
	}
}