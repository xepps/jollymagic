<?php

namespace Jollymagic\Sitemap;

use Jollymagic\Content\FileBasedContentApi;

class SitemapController
{
    private $app;
    private $config;

    public function __construct(\Silex\Application $app, $config)
    {
        $this->app = $app;
        $this->config = $config;
    }

    public function show()
    {
        $sitemap = $this->getSitemapUrls($this->app['baseUrl']);
        return $this->generateSitemap($sitemap);
    }

    private function getSiteConfig()
    {
        $contentApi = new FileBasedContentApi(
            $this->config['routeDir'].$this->config['contentDir']
        );
        return $contentApi->fetchContent();
    }

    private function getSitemapUrls($baseUrl)
    {
        $sitemapUrlBuilder = new SitemapUrlBuilder(
            $baseUrl,
            $this->getSiteConfig()
        );
        return $sitemapUrlBuilder->build();
    }

    private function generateSitemap($sitemap)
    {
        var_dump($sitemap);die;
        return array();
    }
}
