<?php


namespace iikoExchangeBundle\Contract;


interface PeriodicalInterface
{
	public function getPeriod();

	public function setPeriod($period);
}