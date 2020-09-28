<?php


namespace iikoExchangeBundle\Contract\Connection;


interface ConnectionInfoInterface
{
	/**
	 * Return hash view of this structure to create unique id.
	 * Nice to have md5
	 * @return string
	 */
	public function getUnique() : string;
}