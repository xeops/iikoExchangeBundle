<?php


namespace App\Tests;


class ReflectionHelper
{
	public static function invokeMethod($object, $methodName, array $parameters = array())
	{
		$reflection = new \ReflectionClass(get_class($object));
		$method = $reflection->getMethod($methodName);
		$method->setAccessible(true);
		return $method->invokeArgs($object, $parameters);
	}

	public static function getProtectedProperty(&$object, $property)
	{
		$reflection = new \ReflectionClass(get_class($object));
		$reflectionProperty = $reflection->getProperty($property);
		$reflectionProperty->setAccessible(true);
		return $reflectionProperty->getValue($object);
	}

	public static function setProtectedProperty(&$object, $property, $value): void
	{
		$reflection = new \ReflectionClass(get_class($object));
		$reflectionProperty = $reflection->getProperty($property);
		$reflectionProperty->setAccessible(true);
		$reflectionProperty->setValue($object, $value);
	}
}