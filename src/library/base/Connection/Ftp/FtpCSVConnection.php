<?php


namespace iikoExchangeBundle\Library\base\Connection\Ftp;


use iikoExchangeBundle\Contract\AuthStorageInterface;
use iikoExchangeBundle\Contract\Configuration\ConfigItemInterface;
use iikoExchangeBundle\Contract\Connection\ConnectionBuilderInterface;
use iikoExchangeBundle\Contract\Connection\ConnectionInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Library\base\Config\Types\IntConfigItem;
use iikoExchangeBundle\Library\base\Config\Types\PasswordConfigItem;
use iikoExchangeBundle\Library\base\Config\Types\StringConfigItem;
use iikoExchangeBundle\Library\base\Config\Types\UrlConfigItem;
use iikoExchangeBundle\Library\Traits\ConfigurableTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class FtpCSVConnection implements ConnectionInterface, ConnectionBuilderInterface, \JsonSerializable
{
	const CONFIG_HOST = 'HOST';
	const CONFIG_PORT = 'PORT';

	const CONFIG_USERNAME = 'USERNAME';
	const CONFIG_PASSWORD = 'PASSWORD';

	use ConfigurableTrait;

	/** @var LoggerInterface */
	protected LoggerInterface $logger;

	/** @var AuthStorageInterface|null */
	protected AuthStorageInterface $authStorage;

	/**
	 * @inheritDoc
	 */
	public function getCode(): string
	{
		return "FTP_CSV";
	}

	public function setAuthStorage(AuthStorageInterface $authStorage): ConnectionInterface
	{
		$this->authStorage = $authStorage;
		return $this;
	}

	public function setLogger(LoggerInterface $logger): ConnectionInterface
	{
		$this->logger = $logger;
		return $this;
	}

	public function sendRequest(DataRequestInterface $request): ResponseInterface
	{
		$connection = $this->login();
		$content = $request->getRequest()->getBody();

		$handle = fopen('php://temp', 'w+');
		fputcsv($handle, array_keys(current(json_decode($content, true))));

		foreach (json_decode($connection, true) as $row)
		{
			fputcsv($handle, $row);

		}
		rewind($handle);

		if (!ftp_fput($connection, $this->getConfigValue(self::CONFIG_PATH), $handle))
		{
			throw new \Exception();
		}
	}

	protected function login()
	{
		$connection = ftp_connect($this->getConfigValue(self::CONFIG_HOST));
		if (!$connection)
		{
			throw new \Exception();
		}
		if (!ftp_login($connection, $this->getConfigValue(self::CONFIG_USERNAME), $this->getConfigValue(self::CONFIG_PASSWORD)))
		{
			throw new \Exception();
		}
		return $connection;
	}

	protected function createConfig(): array
	{
		return [
			self::CONFIG_HOST => new UrlConfigItem(),
			self::CONFIG_PORT => new IntConfigItem(),
			self::CONFIG_USERNAME => new StringConfigItem(),
			self::CONFIG_PASSWORD => new PasswordConfigItem(),
		];
	}

	/**
	 * @inheritDoc
	 */
	public function jsonSerialize()
	{
		return [
			self::FIELD_CODE => $this->getCode(),
			self::FIELD_CONFIGURATION => $this->getConfiguration()
		];
	}

}