<?php

namespace IikoApiBundle\Request;

use AppBundle\Utils\UniqueLogProcessor;
use IikoApiBundle\Request\iikoApiRequest;

class ServerApi2Request extends iikoApiRequest
{

	protected $type = 'post';
	protected $url = '';

	/**
	 * processResponse function.
	 *
	 * @access protected
	 * @param mixed $response
	 * @return mixed
	 */
	protected function processResponse($response)
	{
		return json_decode($response);
	}

	/**
	 * requestHeaders function.
	 */
	protected function requestHeaders()
	{
		$arr = parent::requestHeaders();
		$arr['Content-Type'] =  "application/json" ;
		$arr['Accept'] = "application/json,text/plain";
		return $arr;
	}


	/**
	 * requestURL function.
	 */
	protected function requestURL()
	{
		return 'v2/' . $this->url . '?key=' . $this->key . "&client-type=iikoweb";
	}

	/**
	 * @param string $lang
	 * @return $this
	 */
	public function setLang(string $lang)
	{
		$this->lang = $lang;
		return $this;
	}




}