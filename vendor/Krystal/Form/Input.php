<?php

/**
 * This file is part of the Krystal Framework
 * 
 * Copyright (c) 2015 David Yang <daworld.ny@gmail.com>
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Krystal\Form;

/* TODO Add support for nested [] names */
final class Input implements InputInterface
{
	/**
	 * Raw input data
	 * 
	 * @var array
	 */
	private $data = array();

	/**
	 * Input name
	 * 
	 * @var string
	 */
	private $name;

	/**
	 * State initialization
	 * 
	 * @param array $data Raw input data
	 * @param string $name
	 * @return void
	 */
	public function __construct(array $data, $name = null)
	{
		$this->data = $data;
		$this->name = $name;
	}

	/**
	 * Checks whether input has a group name
	 * 
	 * @return boolean
	 */
	private function hasName()
	{
		return $this->name !== null;
	}

	/**
	 * Checks whether input has a key
	 * 
	 * @param string $key
	 * @return boolean
	 */
	public function has($key)
	{
		if ($this->hasName()) {
			return isset($this->input[$this->name][$key]);
		} else {
			return isset($this->input[$key]);
		}
	}

	/**
	 * Returns input's name
	 * 
	 * @param string $key
	 * @param mixed $default Default value to be returned in case requested one doesn't exist
	 * @return string
	 */
	public function get($key, $default = false)
	{
		if ($this->has($key)) {

			if ($this->hasName()) {
				return $this->input[$this->name][$key];
			} else {
				return $this->input[$key];
			}

		} else {

			return $default;
		}
	}

	/**
	 * Overdress the input array
	 * 
	 * @param array $input
	 * @return void
	 */
	public function setInput(array $input)
	{
		if ($this->hasName()) {
			$this->input[$this->name] = $input;
		} else {
			$this->input = $input;
		}
	}

	/**
	 * Guesses input's name
	 * 
	 * @param string $key
	 * @return string
	 */
	public function guessName($key)
	{
		if ($this->hasName()) {
			return sprintf('%s[%s]', $this->name, $key);
		} else {
			return $key;
		}
	}
}
