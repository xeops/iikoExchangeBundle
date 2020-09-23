<?php


namespace iikoExchangeBundle\Contract;


interface ExchangeInterface
{
	public function getCode();

	public function getSchedule();

	public function getData();

	public function sendData();

}