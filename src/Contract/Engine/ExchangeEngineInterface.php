<?php


namespace iikoExchangeBundle\Contract\Engine;


use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Contract\DataRequest\UploadDataRequestInterface;
use iikoExchangeBundle\Contract\Exchange\ExchangeInterface;
use iikoExchangeBundle\Contract\Exchange\Trigger\ExchangeOnProcessTriggerInterface;
use iikoExchangeBundle\Contract\ExchangeNodeInterface;
use iikoExchangeBundle\Contract\Mapping\MappingInterface;
use iikoExchangeBundle\Contract\ProviderInterface;
use iikoExchangeBundle\Contract\Transform\TransformInterface;

interface ExchangeEngineInterface extends ExchangeOnProcessTriggerInterface, \JsonSerializable, ExchangeNodeInterface
{
	const FIELD_LOAD_REQUEST = 'loadRequest';
	const FIELD_EXTRACT_REQUEST = 'extractRequest';
	const FIELD_TRANSFORMER = 'transformer';


	public function setLoadRequest(UploadDataRequestInterface $request): self;

	public function addExtractRequest(DataRequestInterface $dataRequest): self;

	public function getExtractRequests() : array;

	public function setTransformer(TransformInterface $transformer): self;

	public function getTransformer() : TransformInterface;

	public function getLoadRequest() : UploadDataRequestInterface;

	public function getMapping(): MappingInterface;

	public function setMapping(MappingInterface $mapping) : self;

	public function getExchange(): ExchangeInterface;

	public function setData(DataRequestInterface $request, $data);

	public function process();

	public function run(): void;
}