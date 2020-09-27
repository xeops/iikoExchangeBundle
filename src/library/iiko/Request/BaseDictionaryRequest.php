<?php


namespace iikoExchangeBundle\Library\iiko\Request;


use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use iikoExchangeBundle\Contract\ConfigInterface;
use iikoExchangeBundle\Contract\DataRequestInterface;
use iikoExchangeBundle\Library\base\Request\AbstractDataRequest;
use iikoExchangeBundle\Library\iiko\Model\IikoEntityDto;
use Psr\Http\Message\RequestInterface;

use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use function GuzzleHttp\Psr7\build_query;

class BaseDictionaryRequest extends AbstractDataRequest
{

	const FILTER_INCLUDE_DELETED = "includeDeleted";
	const FILTER_ROOT_TYPE = "rootType";

	/**
	 * @var LoggerInterface
	 */
	protected $logger;
	protected $type;

	public function __construct(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	final public function getRequest(): RequestInterface
	{
		return new Request(
			'GET',
			(new Uri('/resto/api/v2/entities/list'))->withQuery(build_query(
				[
					self::FILTER_ROOT_TYPE => $this->type
				]
			))
		);
	}

	public function getConfig(): ?ConfigInterface
	{
		return null;
	}

	public function setConfig(ConfigInterface $config): DataRequestInterface
	{
		return $this;
	}

	public function setType($type)
	{
		$this->type = $type;
	}

	public function getCode()
	{
		return 'BASE_DICTIONARY' . $this->type;
	}

	/**
	 * @param $body
	 * @return IikoEntityDto[]
	 */
	public function processResponse($body)
	{
		$data = json_decode($body, true);
		$result = [];

		foreach ($data as $datum)
		{
			$obj = IikoEntityDto::newFromArray($datum);
			$result[$obj->getId()] = $obj;
		}
		return $result;
	}

	public function processError(ResponseInterface $response)
	{
		return [];
	}
}