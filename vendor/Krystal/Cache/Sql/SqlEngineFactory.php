<?php

/**
 * This file is part of the Krystal Framework
 * 
 * Copyright (c) 2015 David Yang <daworld.ny@gmail.com>
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Krystal\Cache\Sql;

use Krystal\Serializer\NativeSerializer;
use PDO;

abstract class SqlEngineFactory
{
	/**
	 * Builds cache engine
	 * 
	 * @param \PDO $pdo
	 * @param string $table Table name
	 * @return \Krystal\Cache\Sql\SqlCacheEngine
	 */
	public static function build(PDO $pdo, $table)
	{
		$mapper = new CacheMapper(new NativeSerializer(), $pdo, $table);

		$engine = new SqlCacheEngine($mapper);
		$engine->initialize();

		return $engine;
	}
}
