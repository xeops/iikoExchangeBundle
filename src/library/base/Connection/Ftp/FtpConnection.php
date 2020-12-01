<?php


namespace iikoExchangeBundle\Library\base\Connection\Ftp;


use GuzzleHttp\Psr7\Response;
use iikoExchangeBundle\Contract\AuthStorageInterface;
use iikoExchangeBundle\Contract\Connection\ConnectionBuilderInterface;
use iikoExchangeBundle\Contract\Connection\ConnectionInterface;
use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;
use iikoExchangeBundle\Library\base\Config\Types\IntConfigItem;
use iikoExchangeBundle\Library\base\Config\Types\PasswordConfigItem;
use iikoExchangeBundle\Library\base\Config\Types\StringConfigItem;
use iikoExchangeBundle\Library\base\Config\Types\UrlConfigItem;
use iikoExchangeBundle\Library\base\Request\FileUploadRequest;
use iikoExchangeBundle\Library\Traits\ConfigurableTrait;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class FtpConnection implements ConnectionInterface, ConnectionBuilderInterface, \JsonSerializable
{
	const CODE = "FTP_CONNECTION";

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
		return static::CODE;
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
		if (!ftp_chdir($connection, $request->getRequest()->getUri()->getPath()))
		{
			throw new \Exception();
		}

		$hash = time();
		parse_str($request->getRequest()->getUri()->getQuery(), $params);
		$fileName = $params['filename'] ?? "newfile.{$hash}.txt";


		if ($request instanceof FileUploadRequest)
		{
			$handle = $request->getFile();
		}
		else
		{
			$content = $request->getRequest()->getBody()->__toString();

			$handle = fopen('php://temp', 'w+');
			fputs($handle, $content);
			rewind($handle);

		}
		$result = ftp_fput($connection, $fileName, $handle);

		fclose($handle);

		if (!$result)
		{
			throw new \Exception();
		}

		return new Response(200, [], 'ok');
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
			new UrlConfigItem(self::CONFIG_HOST),
			new IntConfigItem(self::CONFIG_PORT),
			new StringConfigItem(self::CONFIG_USERNAME),
			new PasswordConfigItem(self::CONFIG_PASSWORD),
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