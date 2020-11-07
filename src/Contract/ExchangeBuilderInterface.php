<?php


namespace iikoExchangeBundle\Contract;


use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Contract\Schedule\ScheduleInterface;

interface ExchangeBuilderInterface
{
	// SET

	public function setDownloadProvider(ProviderInterface $provider);

	public function setUploadProvider(ProviderInterface $provider);

	public function addAdapter(AdapterInterface $adapter);



	// GET

	public function getDownloadProvider() : ProviderInterface;

	public function getUploadProvider() : ProviderInterface;

	/**
	 * @return AdapterInterface[]
	 */
	public function getAdapters() : array;

	/**
	 * @return DataRequestInterface[]
	 */
	public function getRequests() : array;

	public function addSchedule(ScheduleInterface $schedule);

	/**
	 * @return ScheduleInterface[]
	 */
	public function getSchedules() : array;
}