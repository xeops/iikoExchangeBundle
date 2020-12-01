<?php


namespace iikoExchangeBundle\Library\base\Request;


use iikoExchangeBundle\Contract\DataRequest\DataRequestInterface;

class CsvFileUploadRequest extends FileUploadRequest
{
	/**
	 * @param $data
	 * @return CsvFileUploadRequest
	 */
	public function withData($data): DataRequestInterface
	{
		$handle = fopen('php://temp', 'w+');

		fputcsv($handle, array_keys(current(json_decode(json_encode($data), true))));

		foreach ((array)$data as $row)
		{
			fputcsv($handle, json_decode(json_encode($row), true));
		}

		rewind($handle);

		$new = clone $this;
		$new->file = $handle;

		return $new;
	}
}