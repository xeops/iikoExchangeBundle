<?php

namespace App\Tests\iiko\Request;

use App\Tests\ReflectionHelper;
use iikoExchangeBundle\Library\iiko\Model\IikoEntityDto;
use iikoExchangeBundle\Library\iiko\Request\BaseDictionaryRequest;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class BaseDictionaryRequestTest extends TestCase
{
	/** @var BaseDictionaryRequest */
	protected $instance;
	protected function setUp(): void
	{
		parent::setUp();
		$this->instance = new BaseDictionaryRequest($this->createMock(Logger::class));
	}

	public function testGetCode()
	{

	}

	public function testGetRequest()
	{

	}

	public function testSetConfig()
	{

	}

	public function testSetType()
	{

	}

	public function testGetConfig()
	{

	}

	public function testProcessResponse()
	{
		$json = '
		[
			{
		        "rootType": "Account",
		        "accountParentId": null,
		        "parentCorporateId": null,
		        "type": "EMPLOYEES_LIABILITY",
		        "system": false,
		        "customTransactionsAllowed": true,
		        "id": "13000ead-41f0-d569-d85c-704242cc91f5",
		        "deleted": false,
		        "code": "2.02",
		        "name": "Текущие расчеты с сотрудниками"
		    }
		]
		';
		$expected = ["13000ead-41f0-d569-d85c-704242cc91f5" => IikoEntityDto::newFromArray(json_decode($json, true)[0])];

		/** @var IikoEntityDto[] $data */
		$data = ReflectionHelper::invokeMethod($this->instance, 'processResponse', [$json]);
		$this->assertEquals($expected, $data);
	}
}
