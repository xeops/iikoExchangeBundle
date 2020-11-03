<?php


namespace iikoExchangeBundle\Contract;


use iikoExchangeBundle\Contract\Configuration\ConfigurableInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Contract\Mapping\MappingInterface;

interface AdapterInterface extends \JsonSerializable, ConfigurableInterface
{
	const FIELD_MAPPING = 'mapping';

	public function getCode() : string;

	/**
	 * @param MappingInterface $mapping
	 * @return mixed
	 */
	public function addMapping(MappingInterface $mapping);

	/**
	 * @return MappingInterface[]
	 */
	public function getMapping() : array;
	/**
	 * @param ExchangeInterface $exchange
	 * @param string $requestCode
	 * @param mixed $inData
	 * @param mixed $outData
	 * @return mixed
	 */
	public function adapt(ExchangeInterface $exchange, string $requestCode, $inData, &$outData);

	public function setRequestCodes(array $requestCodes);

	public function isRequestAvailable(DataRequestInterface $request);
}