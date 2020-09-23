<?php

namespace App\Tests\Directory;

use iikoExchangeBundle\Contract\AdapterInterface;
use iikoExchangeBundle\Contract\DataRequestInterface;
use iikoExchangeBundle\Contract\DownloadProviderInterface;
use iikoExchangeBundle\Contract\ExchangeInterface;
use iikoExchangeBundle\Contract\UploadProviderInterface;
use iikoExchangeBundle\Directory\ExchangeDirectory;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;
use Symfony\Component\EventDispatcher\EventDispatcher;

class ExchangeDirectoryTest extends TestCase
{
	/** @var ExchangeDirectory */
	protected $instance;

	protected function setUp(): void
	{
		parent::setUp();

		$logger = $this->getMockBuilder(Logger::class)->disableOriginalConstructor()->getMock();
		$dispatcher = $this->getMockBuilder(EventDispatcher::class)->disableOriginalConstructor()->getMock();

		$this->instance = new ExchangeDirectory($logger, $dispatcher);
	}

	public function testGetExchangeByCode()
	{
		$exchange = new TestExchange();
		$this->instance->registerExchange($exchange);

		$this->assertEquals($exchange, $this->instance->getExchangeByCode($exchange->getCode()));
	}

	public function testGetExchanges()
	{
		$this->assertEmpty($this->instance->getExchanges());

		$exchange = new TestExchange();
		$this->instance->registerExchange($exchange);

		$this->assertEquals([$exchange->getCode() => $exchange], $this->instance->getExchanges());

	}

	public function testRegisterExchange()
	{
		$this->assertEmpty($this->instance->getExchanges());

		$exchange = new TestExchange();
		$this->instance->registerExchange($exchange);

		$this->assertEquals([$exchange->getCode() => $exchange], $this->instance->getExchanges());

	}
}

class TestExchange implements ExchangeInterface
{

	public function setDownloadProvider(DownloadProviderInterface $provider)
	{
		// TODO: Implement setDownloadProvider() method.
	}

	public function setUploadProvider(UploadProviderInterface $provider)
	{
		// TODO: Implement setUploadProvider() method.
	}

	public function setAdapter(AdapterInterface $adapter)
	{
		// TODO: Implement setAdapter() method.
	}

	public function addDataRequest(DataRequestInterface $request)
	{
		// TODO: Implement addDataRequest() method.
	}

	public function getCode(): string
	{
		return 'test_exchange';
	}

	public function register()
	{
		// TODO: Implement register() method.
	}

	public function process()
	{
		// TODO: Implement process() method.
	}
}