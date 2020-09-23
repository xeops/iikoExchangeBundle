<?php


namespace iikoExchangeBundle\Contract;


interface ExchangeBuildDirectoryEventInterface
{
	public function getDirectory() : ExchangeDirectoryInterface;
}