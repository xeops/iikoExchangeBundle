<?php


namespace iikoExchangeBundle\Contract;


interface DataUploadDriverInterface extends DataDriverInterface
{
	public function upload($data);
}