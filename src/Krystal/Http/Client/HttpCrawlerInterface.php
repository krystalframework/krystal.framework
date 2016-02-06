<?php

/**
 * This file is part of the Krystal Framework
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Krystal\Http\Client;

interface HttpCrawlerInterface
{
    /**
     * Returns information about the last transfer
     * 
     * @param integer $opt
     * @return mixed
     */
    public function getInfo($opt = 0);

    /**
     * Return error messages if any
     * 
     * @return array
     */
    public function getErrors();

    /**
     * Performs HTTP GET request
     * 
     * @param string $url Target URL
     * @param array $params Parameters
     * @return mixed
     */
    public function get($url, array $params = array());

    /**
     * Performs HTTP GET request
     * 
     * @param string $url Target URL
     * @param array $params Parameters
     * @return mixed
     */
    public function post($url, array $params = array());
}
