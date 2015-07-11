<?php

namespace Jollymagic\Content;

class ContentControllerTest extends \PHPUnit_Framework_TestCase
{
    /***
     * @var ContentController
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
            "second" => (object) array(
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

        $this->contentPresenter = new ContentController();
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

    public function testThat404IsThrownIfPageNotFound()
    {
        $page = "doesNotExist";
        $this->setExpectedException(get_class(new NoContentException($page)), "Page not found: $page", 404);
        $this->contentPresenter->show($page);
    }
}
