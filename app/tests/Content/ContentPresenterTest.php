<?php

namespace Jollymagic\Content;

class ContentPresenterTest extends \PHPUnit_Framework_TestCase
{
    /***
     * @var ContentPresenter
     */
    private $contentPresenter;
    private $mockContentApi;

    public function setUp()
    {
        parent::setUp();

        $this->mockContentApi = new MockContentApi();
        $this->mockContentApi->content = array(
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

        $this->contentPresenter = new ContentPresenter();
        $this->contentPresenter->setApi($this->mockContentApi);
    }

    public function testThatAPagesDataIsReturnedWhenRequested()
    {
        $page = $this->contentPresenter->show('home');

        $this->assertEquals($this->mockContentApi->content['home']->title, $page->content->title);
        $this->assertEquals($this->mockContentApi->content['home']->body, $page->content->body);
        $this->assertEquals($this->mockContentApi->content['home']->backgroundImage, $page->content->backgroundImage);
    }

    public function testThatTheNavIsReturnedAsPartOfAPage()
    {
        $page = $this->contentPresenter->show('home');

        foreach ($page->nav as $key => $navItem) {
            $this->assertEquals($this->mockContentApi->content[$key]->navTitle, $navItem->navTitle);
            $this->assertEquals($this->mockContentApi->content[$key]->url, $navItem->url);
        }
    }
}
