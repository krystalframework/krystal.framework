<?php

/**
 * This file is part of the Krystal Framework
 * 
 * Copyright (c) 2015 David Yang <daworld.ny@gmail.com>
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Krystal\Authentication;

interface RoleHelperInterface
{
	/**
	 * Checks whether stored role equals to a target one
	 * 
	 * @param string $role
	 * @return boolean
	 */
	public function is($role);
}
