<?php


namespace iikoExchangeBundle\Contract;


use Psr\Http\Message\ResponseInterface;

interface DataDownloadDriverInterface extends DataDriverInterface
{
	public function download() : ResponseInterface;
}