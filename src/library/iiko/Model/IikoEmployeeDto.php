<?php
/**
 * Created by PhpStorm.
 * User: vasily
 * Date: 25/01/2018
 * Time: 08:47
 */

namespace IikoApiBundle\Model\Employee;

use iikoExchangeBundle\Contract\Mapping\MappingDTO;

/**
 * An employee
 * Описывает сруктуру, приходящую из iiko:
 *     <employee>
 * <id>21624df3-112e-43d2-a75e-0dde244bb66c</id>
 * <code>28272</code>
 * <name>Abdullah</name>
 * <login></login>
 * <mainRoleCode>CO1</mainRoleCode>
 * <roleCodes>CO1</roleCodes>
 * <firstName>Abdalla</firstName>
 * <lastName>Elgebali</lastName>
 * <cardNumber></cardNumber>
 * <taxpayerIdNumber></taxpayerIdNumber>
 * <snils></snils>
 * <preferredDepartmentCode>16735</preferredDepartmentCode>
 * <departmentCodes>16735</departmentCodes>
 * <responsibilityDepartmentCodes>16735</responsibilityDepartmentCodes>
 * <deleted>false</deleted>
 * <supplier>false</supplier>
 * <employee>true</employee>
 * <client>false</client>
 * </employee>
 *
 *
 *
 *
 */



/**
 * Класс описывающий сущность сотрудник в iikoRms
 * @see https://wiki.iiko.ru/pages/viewpage.action?pageId=42205387
 * Class IikoEmployeeDto
 * @package IikoApiBundle\Model\Employee
 */
class IikoEmployeeDto implements MappingDTO
{
	const DATE_FORMAT = "Y-m-d\TH:i:sP";
	/** @var string */
	protected $id;
	/** @var  string */
	protected $code;
	/** @var string */
	protected $name = '';
	/** @var string|null */
	protected $login = null;
	/** @var string */
	protected $mainRoleCode = '';
	/** @var array */
	protected $roleCodes = [];
	/** @var string|null */
	protected $firstName = '';
	/** @var string|null */
	protected $lastName = '';
	/** @var string|string */
	protected $middleName = '';
	/** @var string|string */
	protected $cardNumber = null;
	/** @var string|null */
	protected $taxpayerIdNumber = null;
	/** @var string|null */
	protected $snils = null;
	/** @var string */
	protected $preferredDepartmentCode = '';
	/** @var array */
	protected $departmentCodes = [];
	/** @var array */
	protected $responsibilityDepartmentCodes = [];
	/** @var bool */
	protected $deleted = false;
	/** @var bool */
	protected $supplier = false;
	/** @var bool */
	protected $employee = true;
	/** @var bool */
	protected $client = true;

	/** @var  string|null */
	protected $note = ''; //Комментарий
	/** @var  \DateTime|null */
	protected $fireDate = null; //Дата увольнения

	//Данные поставщика
	/** @var null|string */
	protected $gln = null; //Global Location Number
	/** @var  \DateTime */
	protected $activationDate = null;
	/** @var  \DateTime */
	protected $deactivationDate = null;

	//Справочная информация
	/** @var string|null */
	protected $phone = null;
	/** @var string|null */
	protected $cellPhone = null;
	/** @var \DateTime|null */
	protected $birthday = null;
	/** @var string|null */
	protected $email = null;
	/** @var string|null */
	protected $address = '';
	/** @var \DateTime|null */
	protected $hireDate = null; //Дата принятия на работу
	/** @var string|null */
	protected $hireDocumentNumber = null; //Номер документа о принятии на работу
	/** @var string */
	protected $password = null;
	/** @var string */
	protected $pinCode = null;

	protected $isCloud = true;

	const FIELD_RMS_PASSWORD = "password", //Поле, пароль к iikoRms
		FIELD_IIKO_FRONT_PIN = "pinCode", // Поле, пин код к iikoFront
		FIELD_FIRE_DATE = "fireDate",//Поле, дата увольнения
		FIELD_NOTE = "note",
		FIELD_ID = "id",
		FIELD_PHONE = "phone",//Поле заметка
		FIELD_MAIN_ROLE_CODE = "mainRoleCode",
		FIELD_DELETED = "deleted",
		FIELD_ROLE_CODES = "roleCodes"; //Основная роль пользователя
	const ROLE_NOT_CLOUD_USER = 'NOT_CLOUD_USER';
	const ROLE_ADMIN = 'ADM';

	/**
	 * Creates an object of the class from an array
	 * @param array $array
	 * @return IikoEmployeeDto
	 */
	public static function newFromArray(array $array)
	{
		$r = new static();
		if (isset($array['id']))
		{
			$r->setId($array['id']);
		}
		if (isset($array['code']) && is_string($array['code']))
		{
			$r->setCode($array['code']);
		}
		if (isset($array['name']))
		{
			$r->setName($array['name']);
		}
		if (isset($array['login']) && is_string($array['login']))
		{
			$r->setLogin($array['login']);
		}
		if (isset($array['mainRoleCode']))
		{
			$r->setMainRoleCode($array['mainRoleCode']);
		}
		if (isset($array['roleCodes']))
		{
			if (is_array($array['roleCodes']))
			{
				foreach ($array['roleCodes'] as $roleCode)
				{
					$r->addRoleCode($roleCode);
				}
			}
			elseif (is_string($array['roleCodes']))
			{
				$r->addRoleCode($array['roleCodes']);
			}
		}
		if (isset($array['firstName']) && is_string($array['firstName']))
		{
			$r->setFirstName($array['firstName']);
		}
		if (isset($array['lastName']) && is_string($array['lastName']))
		{
			$r->setLastName($array['lastName']);
		}
		if (isset($array['middleName']) && is_string($array['middleName']))
		{
			$r->setMiddleName($array['middleName']);
		}
		if (isset($array['cardNumber']) && is_string($array['cardNumber']))
		{
			$r->setCardNumber($array['cardNumber']);
		}
		if (isset($array['taxpayerIdNumber']) && is_string($array['taxpayerIdNumber']))
		{
			$r->setTaxpayerIdNumber($array['taxpayerIdNumber']);
		}
		if (isset($array['snils']) && is_string($array['snils']))
		{
			$r->setSnils($array['snils']);
		}
		if (isset($array['preferredDepartmentCode']) && is_string($array['preferredDepartmentCode']))
		{
			$r->setPreferredDepartmentCode($array['preferredDepartmentCode']);
		}
		if (isset($array['departmentCodes']))
		{
			if (is_array($array['departmentCodes']))
			{
				$r->setDepartmentCodes($array['departmentCodes']);
			}
			elseif (is_string($array['departmentCodes']))
			{
				$r->setDepartmentCodes([$array['departmentCodes']]);
			}
		}
		if (isset($array['responsibilityDepartmentCodes']))
		{
			if (is_array($array['responsibilityDepartmentCodes']))
			{
				$r->setResponsibilityDepartmentCodes($array['responsibilityDepartmentCodes']);
			}
			elseif (is_string($array['responsibilityDepartmentCodes']))
			{
				$r->setResponsibilityDepartmentCodes([$array['responsibilityDepartmentCodes']]);
			}
		}
		if (isset($array['deleted']))
		{
			$r->setDeleted($array['deleted']);
		}
		if (isset($array['supplier']))
		{
			$r->setSupplier($array['supplier']);
		}
		if (isset($array['employee']))
		{
			$r->setEmployee($array['employee']);
		}
		if (isset($array['client']))
		{
			$r->setClient($array['client']);
		}
		if (isset($array['note']) && is_string($array['note']))
		{
			$r->setNote($array['note']);
		}
		if (isset($array['fireDate']))
		{
			if (is_numeric($array['fireDate']))
			{
				$r->setFireDate((new \DateTime())->setTimestamp($array['fireDate']));
			}
			else
			{
				$r->setFireDate(new \DateTime($array['fireDate']));
			}
		}
		if (isset($array['gln']) && is_string($array['gln']))
		{
			$r->setGln($array['gln']);
		}
		if (isset($array['activationDate']))
		{
			if (is_numeric($array['activationDate']))
			{
				$r->setActivationDate((new \DateTime())->setTimestamp($array['activationDate']));
			}
			else
			{
				$r->setActivationDate(new \DateTime($array['activationDate']));
			}
		}
		if (isset($array['deactivationDate']))
		{
			if (is_numeric($array['deactivationDate']))
			{
				$r->setDeactivationDate((new \DateTime())->setTimestamp($array['deactivationDate']));
			}
			else
			{
				$r->setDeactivationDate(new \DateTime($array['deactivationDate']));
			}
		}
		if (isset($array['phone']) && is_string($array['phone']))
		{
			$r->setPhone($array['phone']);
		}
		if (isset($array['cellPhone']) && is_string($array['cellPhone']))
		{
			$r->setCellPhone($array['cellPhone']);
		}
		if (isset($array['birthday']))
		{
			if (is_numeric($array['birthday']))
			{
				$r->setBirthday((new \DateTime())->setTimestamp($array['birthday']));
			}
			else
			{
				$r->setBirthday(new \DateTime($array['birthday']));
			}
		}
		if (isset($array['email']) && is_string($array['email']))
		{
			$r->setEmail($array['email']);
		}
		if (isset($array['address']) && is_string($array['address']))
		{
			$r->setAddress($array['address']);
		}
		if (isset($array['hireDate']))
		{
			if (is_numeric($array['hireDate']))
			{
				$r->setHireDate((new \DateTime())->setTimestamp($array['hireDate']));
			}
			else
			{
				$r->setHireDate(new \DateTime($array['hireDate']));
			}
		}
		if (isset($array['hireDocumentNumber']) && is_string($array['hireDocumentNumber']))
		{
			$r->setHireDocumentNumber($array['hireDocumentNumber']);
		}
		if (isset($array['password']) && is_string($array['password']))
		{
			$r->setPassword($array['password']);
		}
		if (isset($array['pinCode']) && is_string($array['pinCode']))
		{
			$r->setPinCode($array['pinCode']);
		}

		return $r;
	}



	/**
	 * @return string|null
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param string|null $id
	 * @return $this
	 */
	public function setId($id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCode()
	{
		return $this->code;
	}

	/**
	 * @param string|null $code
	 * @return $this
	 */
	public function setCode($code)
	{
		$this->code = $code;
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
	 * @param string $name
	 * @return $this
	 */
	public function setName($name)
	{
		if (!is_string($name))
		{
			$name = '';
		}
		$this->name = $name;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getLogin()
	{
		return $this->login;
	}

	/**
	 * @param string|null $login
	 * @return $this
	 */
	public function setLogin($login)
	{
		$this->login = $login;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getMainRoleCode()
	{
		return $this->mainRoleCode;
	}

	/**
	 * @param string $mainRoleCode
	 * @return $this
	 */
	public function setMainRoleCode($mainRoleCode)
	{
		$this->mainRoleCode = $mainRoleCode;
		return $this;
	}


	/**
	 * @param $roleCode
	 * @return $this
	 */
	public function addRoleCode($roleCode)
	{
		if (!in_array($roleCode, $this->getRoleCodes()))
		{
			$this->roleCodes[] = $roleCode;
		}
		return $this;
	}

	/**
	 * Удалить роль
	 * @param $roleCode
	 * @return $this|IikoEmployeeDto
	 */
	public function removeRoleCode($roleCode)
	{
		$roles = $this->getRoleCodes();
		$index = array_search($roleCode, $roles);
		if ($index === false)
		{
			return $this;
		}
		else
		{
			unset($roles[$index]);
			return $this->setRoleCodes($roles);
		}
	}

	/**
	 * @return array
	 */
	public function getRoleCodes(): array
	{
		return $this->roleCodes;
	}

	/**
	 * @param array $roleCodes
	 * @return $this
	 */
	public function setRoleCodes(array $roleCodes)
	{
		$this->roleCodes = $roleCodes;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * @param string|null $firstName
	 * @return $this
	 */
	public function setFirstName($firstName)
	{
		if (!is_string($firstName))
		{
			$firstName = '';
		}
		$this->firstName = $firstName;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * @param string|null $lastName
	 * @return $this
	 */
	public function setLastName($lastName)
	{
		if (!is_string($lastName))
		{
			$lastName = '';
		}
		$this->lastName = $lastName;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCardNumber()
	{
		return $this->cardNumber;
	}

	/**
	 * @param string|null $cardNumber
	 * @return $this
	 */
	public function setCardNumber($cardNumber)
	{
		$this->cardNumber = $cardNumber;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getTaxpayerIdNumber()
	{
		return $this->taxpayerIdNumber;
	}

	/**
	 * @param string|null $taxpayerIdNumber
	 * @return $this
	 */
	public function setTaxpayerIdNumber($taxpayerIdNumber)
	{
		$this->taxpayerIdNumber = $taxpayerIdNumber;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getSnils()
	{
		return $this->snils;
	}

	/**
	 * @param string|null $snils
	 * @return $this
	 */
	public function setSnils($snils)
	{
		$this->snils = $snils;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getPreferredDepartmentCode()
	{
		return $this->preferredDepartmentCode;
	}

	/**
	 * @param string|null $preferredDepartmentCode
	 * @return $this
	 */
	public function setPreferredDepartmentCode($preferredDepartmentCode)
	{
		$this->preferredDepartmentCode = (string)$preferredDepartmentCode;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getDepartmentCodes(): array
	{
		return $this->departmentCodes;
	}

	/**
	 * @param array $departmentCodes
	 * @return $this
	 */
	public function setDepartmentCodes(array $departmentCodes)
	{
		$this->departmentCodes = $departmentCodes;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getResponsibilityDepartmentCodes(): array
	{
		return $this->responsibilityDepartmentCodes;
	}

	/**
	 * @param array $responsibilityDepartmentCodes
	 * @return $this
	 */
	public function setResponsibilityDepartmentCodes(array $responsibilityDepartmentCodes)
	{
		$this->responsibilityDepartmentCodes = $responsibilityDepartmentCodes;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isDeleted()
	{
		return $this->deleted;
	}

	/**
	 * @param bool $deleted
	 * @return $this
	 */
	public function setDeleted($deleted)
	{
		if (is_string($deleted))
		{
			$this->deleted = $deleted === 'true';
		}
		elseif (is_bool($deleted))
		{
			$this->deleted = $deleted;
		}
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isSupplier(): bool
	{
		return $this->supplier;
	}

	/**
	 * @param bool $supplier
	 * @return $this
	 */
	public function setSupplier($supplier)
	{
		if (is_string($supplier))
		{
			$this->supplier = $supplier === 'true';
		}
		elseif (is_bool($supplier))
		{
			$this->supplier = $supplier;
		}
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isEmployee(): bool
	{
		return $this->employee;
	}

	/**
	 * @param bool $employee
	 * @return $this
	 */
	public function setEmployee($employee)
	{
		if (is_string($employee))
		{
			$this->employee = $employee === "true";
		}
		elseif (is_bool($employee))
		{
			$this->employee = $employee;
		}
		return $this;
	}

	/**
	 * @return bool
	 */
	public function isClient(): bool
	{
		return $this->client;
	}

	/**
	 * @param bool $client
	 * @return $this
	 */
	public function setClient($client)
	{
		if (is_string($client))
		{
			$this->client = $client === "true";
		}
		elseif (is_bool($client))
		{
			$this->client = $client;
		}
		return $this;
	}


	/**
	 * @return string|null
	 */
	public function getMiddleName()
	{
		return $this->middleName;
	}

	/**
	 * @param string|null $middleName
	 * @return $this
	 */
	public function setMiddleName($middleName)
	{
		if (!is_string($middleName))
		{
			$middleName = '';
		}
		$this->middleName = $middleName;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getNote()
	{
		return $this->note;
	}

	/**
	 * @param string|null $note
	 * @return $this
	 */
	public function setNote($note)
	{
		$this->note = $note;
		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getFireDate()
	{
		return $this->fireDate;
	}

	/**
	 * @param \DateTime|null $fireDate
	 * @return $this
	 */
	public function setFireDate($fireDate)
	{
		$this->fireDate = $fireDate;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getGln()
	{
		return $this->gln;
	}

	/**
	 * @param string|null $gln
	 * @return $this
	 */
	public function setGln($gln)
	{
		$this->gln = $gln;
		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getActivationDate()
	{
		return $this->activationDate;
	}

	/**
	 * @param \DateTime|null $activationDate
	 * @return $this
	 */
	public function setActivationDate($activationDate)
	{
		$this->activationDate = $activationDate;
		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getDeactivationDate()
	{
		return $this->deactivationDate;
	}

	/**
	 * @param \DateTime|null $deactivationDate
	 * @return $this
	 */
	public function setDeactivationDate($deactivationDate)
	{
		$this->deactivationDate = $deactivationDate;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getPhone()
	{
		return $this->phone;
	}

	/**
	 * @param string|null $phone
	 * @return $this
	 */
	public function setPhone($phone)
	{
		$this->phone = $phone;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getCellPhone()
	{
		return $this->cellPhone;
	}

	/**
	 * @param string|null $cellPhone
	 * @return $this
	 */
	public function setCellPhone($cellPhone)
	{
		$this->cellPhone = $cellPhone;
		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getBirthday()
	{
		return $this->birthday;
	}

	/**
	 * @param \DateTime|null $birthday
	 * @return $this
	 */
	public function setBirthday(?\DateTime $birthday)
	{
		$this->birthday = $birthday;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param string|null $email
	 * @return $this
	 */
	public function setEmail($email)
	{
		$this->email = $email;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getAddress()
	{
		return $this->address;
	}

	/**
	 * @param string|null $address
	 * @return $this
	 */
	public function setAddress($address)
	{
		$this->address = $address;
		return $this;
	}

	/**
	 * @return \DateTime|null
	 */
	public function getHireDate()
	{
		return $this->hireDate;
	}

	/**
	 * @param \DateTime|null $hireDate
	 * @return $this
	 */
	public function setHireDate($hireDate)
	{
		$this->hireDate = $hireDate;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getHireDocumentNumber()
	{
		return $this->hireDocumentNumber;
	}

	/**
	 * @param string|null $hireDocumentNumber
	 * @return $this
	 */
	public function setHireDocumentNumber($hireDocumentNumber)
	{
		$this->hireDocumentNumber = $hireDocumentNumber;
		return $this;
	}

	/**
	 * Есть ли пересечение со списком сотрудников из другого департамента
	 * @param IikoEmployeeDto $dto
	 * @return bool
	 */
	public function hasAssignedToDepartmentsIntersection(IikoEmployeeDto $dto)
	{
		if (!$this->getDepartmentCodes() || !$dto->getDepartmentCodes())
		{
			return true;
		}
		foreach ($dto->getDepartmentCodes() as $departmentCode)
		{
			if (in_array($departmentCode, $this->getDepartmentCodes()))
			{
				return true;
			}
		}
		return false;
	}

	/**
	 * Serialization
	 */
	public function jsonSerialize()
	{
		$array = [
			'id' => $this->getId(),
			'code' => $this->getCode(),
			'name' => $this->getName(),
			'login' => $this->getLogin(),
			'mainRoleCode' => $this->getMainRoleCode(),
			'roleCodes' => $this->getRoleCodes(),
			'firstName' => $this->getFirstName(),
			'middleName' => $this->getMiddleName(),
			'lastName' => $this->getLastName(),
			'cardNumber' => $this->getCardNumber(),
			'taxpayerIdNumber' => $this->getTaxpayerIdNumber(),
			'snils' => $this->getSnils(),
			'preferredDepartmentCode' => $this->getPreferredDepartmentCode(),
			'departmentCodes' => $this->getDepartmentCodes(),
			'responsibilityDepartmentCodes' => $this->getResponsibilityDepartmentCodes(),
			'deleted' => $this->isDeleted(),
			'supplier' => $this->isSupplier(),
			'employee' => $this->isEmployee(),
			'client' => $this->isClient(),
			'phone' => $this->getPhone(),
			'cellPhone' => $this->getCellPhone(),
			'hireDate' => DateTimeHelper::defaultFormat($this->getHireDate()),
			'hireDocumentNumber' => $this->getHireDocumentNumber(),
			'address' => $this->getAddress(),
			'email' => $this->getEmail(),
			'birthday' => DateTimeHelper::defaultFormat($this->getBirthday()),
			'note' => $this->getNote(),
			'isCloud' => $this->isCloud(),

		];
		if ($this->isSupplier())
		{
			$array['gln'] = $this->getGln();
			$array['activationDate'] = DateTimeHelper::defaultFormat($this->getActivationDate());
			$array['deactivationDate'] = DateTimeHelper::defaultFormat($this->getDeactivationDate());
		}
		if ($this->isEmployee())
		{
			$array['cardNumber'] = $this->getCardNumber();
			$array['fireDate'] = DateTimeHelper::defaultFormat($this->getFireDate());
		}
		return $array;
	}

	/**
	 * @return array
	 */
	public function jsonDefaultEmployeeSerialize()
	{
		$array = [
			'id' => $this->getId(),
			'code' => $this->getCode(),
			'name' => $this->getName(),
			'login' => $this->getLogin(),
			'mainRoleCode' => $this->getMainRoleCode(),
			'roleCodes' => $this->getRoleCodes(),
			'firstName' => $this->getFirstName(),
			'middleName' => $this->getMiddleName(),
			'lastName' => $this->getLastName(),
			'cardNumber' => $this->getCardNumber(),
			'taxpayerIdNumber' => $this->getTaxpayerIdNumber(),
			'snils' => $this->getSnils(),
			'preferredDepartmentCode' => $this->getPreferredDepartmentCode(),
			'departmentCodes' => $this->getDepartmentCodes(),
			'responsibilityDepartmentCodes' => $this->getResponsibilityDepartmentCodes(),
			'deleted' => $this->isDeleted(),
			'supplier' => $this->isSupplier(),
			'employee' => $this->isEmployee(),
			'client' => $this->isClient(),
			'phone' => $this->getPhone(),
			'cellPhone' => $this->getCellPhone(),
			'hireDate' => $this->getHireDate(),
			'hireDocumentNumber' => $this->getHireDocumentNumber(),
			'address' => $this->getAddress(),
			'email' => $this->getEmail(),
			'birthday' => $this->getBirthday(),
			'note' => $this->getNote(),
			'fireDate' => $this->getFireDate()
		];
		return $array;
	}


	/**
	 * @param $departmentCode
	 * @return $this
	 */
	public function addDepartmentCode($departmentCode)
	{
		$this->departmentCodes[] = $departmentCode;
		return $this;
	}


	/**
	 * Привести сущность сотрудник для обновления в iiko
	 * @return array
	 */
	public function formatEmployeeToSave()
	{
		$arr = [
			'name' => $this->getName(),
			'email' => $this->getEmail(),
			'login' => $this->getLogin(),
			'code' => $this->getCode(),
			'mainRoleCode' => $this->getMainRoleCode(),
			'phone' => $this->getPhone(),
			'cellPhone' => $this->getCellPhone(),
			'firstName' => $this->getFirstName(),
			'middleName' => $this->getMiddleName(),
			'lastName' => $this->getLastName(),
			'cardNumber' => $this->getCardNumber(),
			'taxpayerIdNumber' => $this->getTaxpayerIdNumber(),
			'address' => $this->getAddress(),
			'snils' => $this->getSnils(),
			'roleCodes' => $this->getRoleCodes(),
		];
		if ($this->getResponsibilityDepartmentCodes())
		{
			$arr['responsibilityDepartmentCodes'] = $this->getResponsibilityDepartmentCodes();
		}
		if ($this->getDepartmentCodes())
		{
			$arr['departmentCodes'] = $this->getDepartmentCodes();
		}
		if ($this->getPreferredDepartmentCode())
		{
			$arr['preferredDepartmentCode'] = $this->getPreferredDepartmentCode();
		}
		if ($this->getGln())
		{
			$arr['gln'] = $this->getGln();
		}
		$arr['hireDocumentNumber'] = $this->getHireDocumentNumber();
		$arr['note'] = $this->getNote();
		$arr['birthday'] = !$this->getBirthday() ? null : $this->getBirthday()->format("Y-m-d");
		$arr['hireDate'] = !$this->getHireDate() ? null : $this->getHireDate()->format("Y-m-d");
		$arr['activationDate'] = !$this->getActivationDate() ? null : $this->getActivationDate()->format("Y-m-d");
		$arr['deactivationDate'] = !$this->getDeactivationDate() ? null : $this->getDeactivationDate()->format("Y-m-d");
		return $arr;
	}

	/**
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
	}

	/**
	 * @param string $password
	 * @return $this
	 */
	public function setPassword($password)
	{
		$this->password = (string)$password;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPinCode()
	{
		return $this->pinCode;
	}

	/**
	 * @param string $pinCode
	 * @return $this
	 */
	public function setPinCode($pinCode)
	{
		$this->pinCode = (string)$pinCode;
		return $this;
	}


}
