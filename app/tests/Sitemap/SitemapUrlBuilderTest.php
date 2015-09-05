<?php

namespace Jollymagic\Sitemap;

class SitemapUrlBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testThatGivenASiteMapItGeneratesAListOfSitemapUrlObjects()
    {
        $sitemapUrlBuilder = new SitemapUrlBuilder('http://test.com', $this->getMockSiteConfig());

        $this->assertEquals(array(
                (object)array(
                    'loc' => 'http://test.com/',
                    'changefreq' => 'monthly',
                    'priority' => '1.00'
                ),
                (object)array(
                    'loc' => 'http://test.com/test',
                    'changefreq' => 'hourly',
                    'priority' => '0.80'
                )
            ),
            $sitemapUrlBuilder->build()
        );
    }

    private function getMockSiteConfig()
    {
        return (object) array(
            'index' => (object)array(
                    'url' => '/',
                    'changeFrequency' => 'monthly',
                    'priority' => '1.00'
                ),
            'not-wanted' => (object)array(
                    'doNotSitemap' => true
                ),
            'test' => (object)array(
                    'url' => '/test',
                    'changeFrequency' => 'hourly',
                    'priority' => '0.80'
                ),
        );
    }
}
