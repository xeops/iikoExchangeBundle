<?php


namespace iikoExchangeBundle\Contract;


use Psr\Http\Message\ResponseInterface;

interface DownloadProviderInterface extends ProviderInterface
{
	public function download() : ResponseInterface;
}