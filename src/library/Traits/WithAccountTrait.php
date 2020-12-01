<?php


namespace iikoExchangeBundle\Library\Traits;


trait WithAccountTrait
{
	protected $account;

	public function getAccount()
	{
		return $this->account;
	}

	public function setAccount($account)
	{
		$this->account = $account;
	}
}