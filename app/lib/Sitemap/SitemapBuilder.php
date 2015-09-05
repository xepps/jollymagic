<?php

namespace Jollymagic\Sitemap;

class SitemapBuilder
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
        $rootNode = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' .
            'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' .
            'xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' .
            'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" />';

        $urls = $this->generateSitemapStructure();
        $root = new \SimpleXMLElement($rootNode);
        foreach ($urls as $url) {
            $node = $root->addChild('url');
            $node->addChild('loc', $url->loc);
            $node->addChild('changefreq', $url->changefreq);
            $node->addChild('priority', $url->priority);
        }
        return $root->asXml();
    }

    private function generateSitemapStructure()
    {
        $sitemapUrls = array();
        foreach ($this->siteConfig as $page) {
            if (isset($page->doNotSitemap) && $page->doNotSitemap) {
                continue;
            }
            $sitemapUrls []= (object) array(
                'loc' => $this->baseUrl . $page->url,
                'changefreq' => $page->changeFrequency,
                'priority' => $page->priority
            );
        }
        return $sitemapUrls;
    }
}
