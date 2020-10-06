<?php


namespace iikoExchangeBundle\Library\base\Connection\OAuth1;


use iikoExchangeBundle\Contract\Connection\ConnectionInfoInterface;
use iikoExchangeBundle\Library\base\Config\Types\PasswordConfig;
use iikoExchangeBundle\Library\base\Config\Types\StringConfig;

class OAuth1ConnectionInfo implements ConnectionInfoInterface
{
	protected $grantType;
	protected $clientId;
	protected $clientSecret;
	protected $scope;

	/**
	 * @inheritDoc
	 */
	public function getUnique(): string
	{
		// TODO: Implement getUnique() method.
	}

	public function getConfig(): array
	{
		return [
			'client_id' => new StringConfig(),
			'data_type' => new StringConfig(),
			'client_secret' => new StringConfig(),
			'scope' => new StringConfig()
		];
	}

	public function __unserialize(array $data): void
	{
		$this->clientId = $data['client_id'];
		$this->grantType = $data['data_type'];
		$this->clientSecret = $data['client_secret'];
		$this->scope = $data['scope'];
	}
}