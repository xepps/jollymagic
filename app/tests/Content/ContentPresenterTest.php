<?php

namespace Jollymagic\Content;

class ContentPresenterTest extends \PHPUnit_Framework_TestCase
{
    public function testThatAPagesDataIsReturnedWhenRequested()
    {
        $mockContentApi = new MockContentApi();
        $mockContentApi->content = (object) array(
            "home" => (object) array(
                "url" => "/",
                "navTitle" => "Mr Jolly",
                "backgroundImage" => "alan.jpeg",
                "title" => "Hi, I'm Al Jolly",
                "body" => array(
                    "Paragraph one £&£",
                    "Paragraph two"
                )
            ),
            "secondPage" => (object) array(
                "url" => "/second",
                "navTitle" => "Title",
                "backgroundImage" => "image.jpeg",
                "title" => "Hi, I'm Al Jolly",
                "body" => array(
                    "Paragraph one £&£",
                    "Paragraph two"
                )
            ),
        );

        $contentPresenter = new ContentPresenter();
        $contentPresenter->setApi($mockContentApi);
        $page = $contentPresenter->show('home');

        $this->assertEquals($mockContentApi->content->home->title, $page->content->title);
        $this->assertEquals($mockContentApi->content->home->body, $page->content->body);
        $this->assertEquals($mockContentApi->content->home->backgroundImage, $page->content->backgroundImage);
    }
}
