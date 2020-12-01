<?php


namespace iikoExchangeBundle\Library\base\Connection\Ftp;


class SftpConnection extends FtpConnection
{

	const CODE = 'SFTP_CONNECTION';

	protected function login()
	{
		$connection = ssh2_connect($this->getConfigValue(self::CONFIG_HOST), $this->getConfigValue(self::CONFIG_PORT));
		if (!$connection)
		{
			throw new \Exception();
		}
		if (!ssh2_auth_password($connection, $this->getConfigValue(self::CONFIG_USERNAME), $this->getConfigValue(self::CONFIG_PASSWORD)))
		{
			throw new \Exception();
		}
		return ssh2_sftp($connection);
	}

}