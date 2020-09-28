<?php


namespace iikoExchangeBundle\Contract;


interface AuthDataInterface extends \JsonSerializable
{
	public static function jsonDeserialize(string $json) : self;
}