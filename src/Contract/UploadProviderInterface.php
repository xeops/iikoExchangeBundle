<?php


namespace iikoExchangeBundle\Contract;


interface UploadProviderInterface extends ProviderInterface
{
	public function upload($data);
}