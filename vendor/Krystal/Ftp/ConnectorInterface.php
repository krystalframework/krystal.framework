<?php/** * This file is part of the Krystal Framework *  * Copyright (c) 2015 David Yang <daworld.ny@gmail.com> *  * For the full copyright and license information, please view * the license file that was distributed with this source code. */namespace Krystal\Ftp;interface ConnectorInterface{	/**	 * Return defined options	 * 	 * @return array	 */	public function getOptions();	/**	 * Connects to the server	 * 	 * @return boolean	 */	public function connect();}