<?php


namespace iikoExchangeBundle\Contract\Mapping;


interface MappingItemInterface
{
	public function getId(): string;

	public function getCode(): string;

	public function getValue(): string;

	public function getProperties(): array;
}