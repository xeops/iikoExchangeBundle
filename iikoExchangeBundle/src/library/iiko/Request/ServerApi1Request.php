<?php

namespace IikoApiBundle\Request;

class ServerApi1Request extends iikoApiRequest
{
	protected $enableClientType = false;

	/**
	 * processResponse function.
	 *
	 * @access protected
	 * @param mixed $response
	 * @return mixed|\SimpleXMLElement
	 */
	protected function processResponse($response)
	{
		$xml = simplexml_load_string($response);
		return $xml;

	}


}