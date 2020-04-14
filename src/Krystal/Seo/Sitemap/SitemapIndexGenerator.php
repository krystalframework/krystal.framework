<?php

/**
 * This file is part of the Krystal Framework
 * 
 * Copyright (c) No Global State Lab
 * 
 * For the full copyright and license information, please view
 * the license file that was distributed with this source code.
 */

namespace Krystal\Seo\Sitemap;

final class SitemapIndexGenerator extends AbstractGenerator
{
    /**
     * Root attributes
     * 
     * @var array
     */
    protected $rootAttributes = array(
        'xmlns' => 'http://www.sitemaps.org/schemas/sitemap/0.9'
    );

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        return $this->createTree('sitemapindex');
    }

    /**
     * Add single Sitemap
     * 
     * @param array $sitemaps
     * @return void
     */
    public function addSitemaps(array $sitemaps)
    {
        foreach ($urls as $url) {
            $this->addUrl(
                self::safeValue('loc', $url),
                self::safeValue('lastmod', $url)
            );
        }
    }

    /**
     * Add single Sitemap
     * 
     * @param string $loc
     * @param string $loc
     * @return void
     */
    public function addSitemap($loc, $lastmod = null)
    {
        $node = $this->createBranch('sitemap', array(
            'loc' => $loc,
            'lastmod' => $lastmod
        ));

        $this->items[] = $node;
    }
}
