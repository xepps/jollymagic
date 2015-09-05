<?php

namespace Jollymagic\Sitemap;

class SitemapUrlBuilder
{
    private $baseUrl;
    private $siteConfig;

    public function __construct($baseUrl, $siteConfig)
    {
        $this->baseUrl = $baseUrl;
        $this->siteConfig = $siteConfig;
    }

    public function build()
    {
        $sitemapUrls = array();
        foreach ($this->siteConfig as $page) {
            if (isset($page->doNotSitemap) && $page->doNotSitemap) continue;
            $sitemapUrls []= (object) array(
                'loc' => $this->baseUrl . $page->url,
                'changefreq' => $page->changeFrequency,
                'priority' => $page->priority
            );
        }
        return $sitemapUrls;
    }
}
