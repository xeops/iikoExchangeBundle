<?php
/**
 * Created by PhpStorm.
 * User: vasily
 * Date: 10/09/2017
 * Time: 22:23
 */

namespace iikoExchangeBundle\Library\iiko\Model;
/**
 * @see https://wiki.iiko.ru/pages/viewpage.action?pageId=54332850
 * Class IikoEntityDto
 * @package IikoApiBundle\Entities
 */
class IikoEntityDto implements \JsonSerializable
{

	const ENTITY_ACCOUNT = 'Account';
	const ENTITY_ACCOUNTING_CATEGORY = 'AccountingCategory';
	const ENTITY_PRODUCT_CATEGORY = 'ProductCategory';
	const ENTITY_TAX_CATEGORY = 'TaxCategory';
	const ENTITY_ALCO_CLASS = 'AlcoholClass';
	const ENTITY_DISCOUNT_TYPE = 'DiscountType';
	const ENTITY_MEASURE_UNIT = 'MeasureUnit';
	const ENTITY_PAYMENT_TYPE = 'PaymentType';
	const ENTITY_ORDER_TYPE = 'OrderType'; // 6.4 - Тип заказа
	const ENTITY_PRODUCT_SIZE = 'ProductSize'; //6.4 - Размер продукта

	const ORDER_TYPE_COMMON = "COMMON", //Обычный заказ
		ORDER_TYPE_DELIVERY_BY_COURIER = "DELIVERY_BY_COURIER", //Доставка курьером
		ORDER_TYPE_DELIVERY_PICKUP = "DELIVERY_PICKUP"; //Доставка самовывоз

	const AVAILABLE_ORDER_SERVICE_TYPE = [
		self::ORDER_TYPE_COMMON,
		self::ORDER_TYPE_DELIVERY_BY_COURIER,
		self::ORDER_TYPE_DELIVERY_PICKUP
	];

	/** @var string */
	protected $name;
	/** @var string */
	protected $code;
	/** @var string */
	protected $type;
	/** @var string */
	protected $id;
	/** @var string */
	protected $entityType;
	/** @var bool */
	protected $deleted = false;
	/** @var  float */
	protected $vatPercent;

	/** @var string */
	protected $shortName; //6.4 - Короткое название для размера

	/** @var string */
	protected $orderServiceType; //6.4 - Режим обслуживания
	/** @var string */
	protected $defaultForServiceType; //6.4 - У каждого из режимов обслуживания может быть выбран один тип заказа по умолчанию


	/**
	 * @param array $array
	 * @return static
	 */
	public static function newFromArray(array $array)
	{
		$r = new static();
		if (isset($array['id'])) {
			$r->setId($array['id']);
		}
		if (isset($array['name'])) {
			$r->setName($array['name']);
		}
		if (isset($array['code'])) {
			$r->setCode($array['code']);
		}
		if (isset($array['rootType'])) {
			$r->setEntityType($array['rootType']);
		}
		if (isset($array['deleted'])) {
			$r->setDeleted($array['deleted']);
		}
		if ($r->getEntityType() == self::ENTITY_TAX_CATEGORY &&
			isset($array['vatPercent'])) {
			$r->setVatPercent($array['vatPercent']);
		}
		if ($r->getEntityType() == self::ENTITY_PRODUCT_SIZE &&
			isset($array['shortName'])) {
			$r->setShortName($array['shortName']);
		}
		if ($r->getEntityType() == self::ENTITY_ORDER_TYPE) {
			if (isset($array['orderServiceType'])) {
				$r->setOrderServiceType($array['orderServiceType']);
			}
			if (isset($array['defaultForServiceType'])) {
				$r->setDefaultForServiceType($array['defaultForServiceType']);
			}
		}
		if ($r->getEntityType() == self::ENTITY_ACCOUNT) {
			if (isset($array['type'])) {
				$r->setType($array['type']);
			}
		}
		return $r;
	}

	/**
	 * @return string
	 */
	public function getShortName()
	{
		return $this->shortName;
	}

	/**
	 * @param string $shortName
	 * @return IikoEntityDto
	 */
	public function setShortName(string $shortName): IikoEntityDto
	{
		$this->shortName = $shortName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getOrderServiceType()
	{
		return $this->orderServiceType;
	}

	/**
	 * @param string $orderServiceType
	 * @return IikoEntityDto
	 */
	public function setOrderServiceType(string $orderServiceType): IikoEntityDto
	{
		$this->orderServiceType = $orderServiceType;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDefaultForServiceType()
	{
		return $this->defaultForServiceType;
	}

	/**
	 * @param string $defaultForServiceType
	 * @return IikoEntityDto
	 */
	public function setDefaultForServiceType(string $defaultForServiceType): IikoEntityDto
	{
		$this->defaultForServiceType = $defaultForServiceType;
		return $this;
	}


	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return string
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getEntityType()
	{
		return $this->entityType;
	}

	/**
	 * @return bool
	 */
	public function isDeleted(): bool
	{
		return $this->deleted;
	}

	public function jsonSerialize()
	{
		$arr = [
			'id' => $this->id,
			'name' => $this->name,
			'code' => $this->code,
			'rootType' => $this->entityType,
			'deleted' => $this->deleted,
		];
		if ($this->getEntityType() == self::ENTITY_ACCOUNT) {
			$arr['type'] = $this->getType();
		}
		if ($this->getEntityType() == self::ENTITY_TAX_CATEGORY) {
			$arr['vatPercent'] = $this->getVatPercent();
		}
		if ($this->getEntityType() == self::ENTITY_PRODUCT_SIZE) {
			$arr['shortName'] = $this->getShortName();
		}
		if ($this->getEntityType() == self::ENTITY_ORDER_TYPE) {
			$arr['orderServiceType'] = $this->getOrderServiceType();
			$arr['defaultForServiceType'] = $this->getDefaultForServiceType();
		}
		return $arr;
	}

	/**
	 * @param string $name
	 * @return IikoEntityDto
	 */
	public function setName($name)
	{
		$this->name = $name;
		return $this;
	}

	/**
	 * @param string $code
	 * @return IikoEntityDto
	 */
	public function setCode($code)
	{
		$this->code = $code;
		return $this;
	}

	/**
	 * @param string $id
	 * @return IikoEntityDto
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @param string $entityType
	 * @return IikoEntityDto
	 */
	public function setEntityType($entityType)
	{
		$this->entityType = $entityType;
		return $this;
	}

	/**
	 * @param bool $deleted
	 * @return IikoEntityDto
	 */
	public function setDeleted($deleted)
	{
		$this->deleted = $deleted;
		return $this;
	}

	/**
	 * @return float
	 */
	public function getVatPercent()
	{
		return $this->vatPercent;
	}

	/**
	 * @param float $vatPercent
	 * @return IikoEntityDto
	 */
	public function setVatPercent($vatPercent)
	{
		$this->vatPercent = $vatPercent;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}

	/**
	 * @param string $type
	 * @return IikoEntityDto
	 */
	public function setType(string $type): IikoEntityDto
	{
		$this->type = $type;
		return $this;
	}


}