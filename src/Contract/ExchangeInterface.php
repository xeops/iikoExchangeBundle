<?php


namespace iikoExchangeBundle\Contract;


use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;
use iikoExchangeBundle\Contract\DataRequest\UploadDataRequestInterface;
use iikoExchangeBundle\Contract\Schedule\ScheduleInterface;

interface ExchangeInterface extends ExchangeBuilderInterface, \JsonSerializable, ConfigurableInterface
{
	const FIELD_PROVIDER = 'providers';
	const FIELD_DOWNLOAD_PROVIDER = 'download';
	const FIELD_UPLOAD_PROVIDER = 'upload';
	const FIELD_ADAPTER = 'adapters';
	const FIELD_REQUEST = 'requests';
	const FIELD_SCHEDULE = 'schedules';


	public function register(ExchangeBuildDirectoryEventInterface $event);

	public function process();
	
	public function asTables();

	public function addUploadRequest(UploadDataRequestInterface $dataRequest) : self;
}