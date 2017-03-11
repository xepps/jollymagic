<?php

namespace Jollymagic\Sitemap;

class SitemapBuilderTest extends \PHPUnit_Framework_TestCase
{
    public function testThatGivenASiteMapItGeneratesAListOfSitemapUrlObjects()
    {
        // $sitemapBuilder = new SitemapBuilder('http://test.com', $this->getMockSiteConfig());
        // $expectedSitemap =
        //     '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"' .
        //             'xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' .
        //             'xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' .
        //                 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' .
        //         '<url>' .
        //             '<loc>http://test.com/</loc>' .
        //             '<changefreq>monthly</changefreq>' .
        //             '<priority>1.00</priority>' .
        //         '</url>' .
        //         '<url>' .
        //             '<loc>http://test.com/test</loc>' .
        //             '<changefreq>hourly</changefreq>' .
        //             '<priority>0.80</priority>' .
        //         '</url>' .
        //     '</urlset>';

        // $this->assertXmlStringEqualsXmlString(
        //     $expectedSitemap,
        //     $sitemapBuilder->build()
        // );
    }

    private function getMockSiteConfig()
    {
        return (object)array(
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
