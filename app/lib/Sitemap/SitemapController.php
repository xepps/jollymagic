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
        $sitemap = $this->buildSitemap($this->app['baseUrl']);
        return $sitemap;
    }

    private function getSiteConfig()
    {
        $contentApi = new FileBasedContentApi(
            $this->config['routeDir'].$this->config['contentDir']
        );
        return $contentApi->fetchContent();
    }

    private function buildSitemap($baseUrl)
    {
        $sitemapUrlBuilder = new SitemapBuilder(
            $baseUrl,
            $this->getSiteConfig()
        );
        return $sitemapUrlBuilder->build();
    }

}
