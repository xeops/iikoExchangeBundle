<?php


namespace iikoExchangeBundle\Library\Traits;


trait WithRestaurantTrait
{
	protected $restaurant;

	public function getRestaurant()
	{
		return $this->restaurant;
	}

	public function setRestaurant($restaurant)
	{
		$this->restaurant = $restaurant;
	}
}