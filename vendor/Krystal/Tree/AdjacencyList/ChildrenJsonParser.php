<?php

/**
 * This file is part of the Krystal Framework
 * 
 * Copyright (c) 2015 David Yang <daworld.ny@gmail.com>
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Krystal\Tree\AdjacencyList;

final class ChildrenJsonParser extends ChildrenParser
{
	/**
	 * Parses JSON data
	 * 
	 * @param string $json JSON data as a string
	 * @return array
	 */
	public function parse($json)
	{
		$data = json_decode($json, true);
		return $this->parseData($data);
	}

	/**
	 * Updates orders
	 * 
	 * @param string $json JSON string
	 * @param \Krystal\Tree\AdjacencyList\ChildrenOrderSaverMapperInterface $mapper
	 * @return boolean
	 */
	public function update($json, ChildrenOrderSaverMapperInterface $mapper)
	{
		$array = $this->parse($json);

		foreach ($array as $range => $value) {
			if (is_array($value)) {
				$mapper->save($value[$this->idKey], $value[$this->parentKey], $range);
			}
		}

		return true;
	}
}
