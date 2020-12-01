<?php


namespace iikoExchangeBundle\Contract;


use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Contract\DataRequest\UploadDataRequestInterface;
use iikoExchangeBundle\Contract\Mapping\MappingInterface;

interface AdapterInterface extends \JsonSerializable, ConfigurableInterface
{
	const FIELD_MAPPING = 'mapping';

	public function getCode(): string;

	/**
	 * @param MappingInterface $mapping
	 * @return mixed
	 */
	public function addMapping(MappingInterface $mapping);

	/**
	 * @return MappingInterface[]
	 */
	public function getMapping(): array;

	/**
	 * @param ExchangeInterface $exchange
	 * @param UploadDataRequestInterface $requestCode
	 * @param $inData
	 * @return mixed
	 */
	public function adapt(ExchangeInterface $exchange, string $donwloadRequestCode, UploadDataRequestInterface &$requestCode, $inData);

	public function setRequestCodes(array $requestCodes): self;

	public function isRequestAvailable(DataRequestInterface $request);
}