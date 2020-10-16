<?php


namespace iikoExchangeBundle\Contract;


use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;
use iikoExchangeBundle\Contract\Schedule\ScheduleInterface;

interface ExchangeInterface extends ExchangeBuilderInterface, \JsonSerializable, ConfigurableInterface
{
	const FIELD_PROVIDER = '_providers';
	const FIELD_DOWNLOAD_PROVIDER = '_download';
	const FIELD_UPLOAD_PROVIDER = '_upload';
	const FIELD_ADAPTER = '_adapters';
	const FIELD_REQUEST = '_requests';
	const FIELD_SCHEDULE = '_schedules';


	public function register(ExchangeBuildDirectoryEventInterface $event);

	public function process();



	public function asTables();
}