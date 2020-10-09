<?php


namespace iikoExchangeBundle\Library\iiko\Request;


use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use IikoApiBundle\Model\Employee\IikoEmployeeDto;
use iikoExchangeBundle\Library\base\Request\AbstractDataRequest;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\Psr7\build_query;

class EmployeeDictionaryRequest extends AbstractDataRequest
{

	public function getCode()
	{
		return "DICTIONARY.EMPLOYEE";
	}

	public function getRequest(): RequestInterface
	{
		return new Request('GET', (new Uri('/resto/api/employees')));
	}

	public function processResponse($body)
	{
		$xml = simplexml_load_string($body);
		$data = json_decode(json_encode($xml), true);
		$result = [];

		if (isset($data['employee'][0])) {
			foreach ($data['employee'] as $datum) {
				$item = IikoEmployeeDto::newFromArray($datum);
				$result[$item->getId()] = $item;
			}
		} else {
			$item = IikoEmployeeDto::newFromArray($data['employee']);
			$result[$item->getId()] = $item;
		}
		return $result;
	}

	public function processError(ResponseInterface $response)
	{
		return;
	}
}