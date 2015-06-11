<?php

/**
 * This file is part of the Krystal Framework
 * 
 * Copyright (c) 2015 David Yang <daworld.ny@gmail.com>
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Krystal\Stdlib;

final class MagicQuotesFilter implements MagicQuotesFilterInterface
{
	/**
	 * Deactivates magic quotes at runtime
	 * 
	 * @return void
	 */
	public function deactivate()
	{
		// This function is deprecated as of 5.4
		if (function_exists('set_magic_quotes_runtime')) {
			set_magic_quotes_runtime(false);
		}
	}

	/**
	 * Checks whether magic quotes are enabled
	 * 
	 * @return boolean
	 */
	public function enabled()
	{
		return (bool) get_magic_quotes_gpc();
	}

	/**
	 * Recursively filter slashes in array
	 * 
	 * @param mixed $value
	 * @return array
	 */
	public function filter($value)
	{
		return is_array($value) ? array_map(array($this, __FUNCTION__), $value) : stripslashes($value);
	}
}
