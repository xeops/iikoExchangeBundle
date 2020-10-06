<?php

namespace App\Tests\base\Exchange;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use iikoExchangeBundle\Contract\AdapterConfigInterface;
use iikoExchangeBundle\Contract\AdapterInterface;
use iikoExchangeBundle\Library\base\Connection\AbstractDigestConnection;
use iikoExchangeBundle\Library\base\Connection\AbstractProvider;
use iikoExchangeBundle\Library\base\Exchange\Exchange;
use PHPUnit\Framework\TestCase;
use PHPUnit\Util\Test;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ExchangeTest extends TestCase
{

	protected $instance;

	public function setUp(): void
	{
		parent::setUp(); // TODO: Change the autogenerated stub
		$this->instance = new TestExchange();
	}

	public function testSetAdapter()
	{

	}

	public function testSetUploadProvider()
	{

	}

	public function testAddDataRequest()
	{

	}

	public function testRegister()
	{

	}

	public function testProcess()
	{
		$connection = new TestConnection();
		$this->instance
			->setAdapter(new TestAdapter())
			->setDownloadProvider(new TestProvider())
			->setUploadProvider(new TestProvider());

		$this->assertEquals(200, $this->instance->process()->getStatusCode());

	}

	public function testSetDownloadProvider()
	{

	}

	public function testGetCode()
	{

	}
}
class TestProvider extends AbstractProvider
{
	public function sendRequest(RequestInterface $request): ResponseInterface
	{
		return new Response(200, [], 'OK');
	}
}
class TestAdapter implements AdapterInterface
{

	public function getConfig(): ?AdapterConfigInterface
	{
		return null;
	}

	public function adapt($data)
	{
		return new Request('POST', '/send/data');
	}
}
class TestExchange extends Exchange
{

	public function getCode(): string
	{
		return 'TEST_EXCHANGE';
	}
}

class TestConnection extends AbstractDigestConnection
{


	protected function login()
	{
		$this->authStorage->storeAuthData($this->authStorage->getAuthData()->setToken('123'));
	}
}