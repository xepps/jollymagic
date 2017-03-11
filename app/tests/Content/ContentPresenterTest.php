<?php

namespace Jollymagic\Content;

use Jollymagic\Components\MockComponentPresenter;

class ContentPresenterTest extends \PHPUnit_Framework_TestCase
{
    private $mockContentApi;

    public function setUp()
    {
        parent::setUp();

        $this->mockContentApi = new MockContentApi();
        $this->mockContentApi->content = (object) array(
            "home" => (object) array(
                "url" => "/",
                "navTitle" => "Mr Jolly",
                "description" => "I'm a description",
                "backgroundImage" => "alan.jpeg",
                "title" => "Hi, I'm Al Jolly",
                "bodyText" => array(
                    "Paragraph __one__ £&£",
                    "Paragraph two"
                )
            ),
            "second" => (object) array(
                "url" => "/second",
                "navTitle" => "Title",
                "description" => "I'm a description",
                "backgroundImage" => "image.jpeg",
                "title" => "Hi, I'm Al Jolly",
                "bodyText" => array(
                    "Paragraph one £&£",
                    "Paragraph two"
                )
            ),
            "booking" => (object) array(
                "url" => "/booking",
                "navTitle" => "booking",
                "description" => "I'm a description",
                "backgroundImage" => "image.jpeg",
                "title" => "Book me",
                "bodyText" => array(
                    "Paragraph one £&£",
                ),
                "components" => array(
                    "Jollymagic\\Components\\MockComponentPresenter"
                )
            )
        );
        $this->mockContentApi->footer = (object) array(
            "email" => "info@jollymagic.com",
            "address" => [
                "Jollymagic",
                "15 Osbourne Road",
                "Walton-Le-Dale",
                "Preston",
                "PR5 4GL"
            ],
            "telephone" => [
                "01772 336167",
                "07971 043376"
            ]
        );
    }

    public function testThatAPagesDataIsReturnedWhenRequested()
    {
        $expectedBodyText = "<p>Paragraph <strong>one</strong> £&amp;£</p><p>Paragraph two</p>";

        $contentPresenter = new ContentPresenter('home');
        $contentPresenter->api = $this->mockContentApi;
        $page = $contentPresenter->present();

        $this->assertEquals($this->mockContentApi->content->home->title, $page->content->title);
        $this->assertEquals($this->mockContentApi->content->home->description, $page->content->description);
        $this->assertEquals($expectedBodyText, $page->content->body);
        $this->assertEquals($this->mockContentApi->content->home->backgroundImage, $page->content->backgroundImage);

        $this->assertEquals($this->mockContentApi->footer, $page->footer);
    }

    public function testThatTheNavIsReturnedAsPartOfAPage()
    {
        $contentPresenter = new ContentPresenter('home');
        $contentPresenter->api = $this->mockContentApi;
        $page = $contentPresenter->present();

        foreach ($page->nav as $key => $navItem) {
            $this->assertEquals($this->mockContentApi->content->{$key}->navTitle, $navItem->title);
            $this->assertEquals($this->mockContentApi->content->{$key}->url, $navItem->url);
        }
    }

    public function testThat404IsThrownIfPageNotFound()
    {
        $page = "doesNotExist";
        $this->setExpectedException(get_class(new NoContentException($page)), "Page not found: $page", 404);

        $contentPresenter = new ContentPresenter($page);
        $contentPresenter->api = $this->mockContentApi;
        $contentPresenter->present();
    }

    public function testThatPageComponentsGetRendered()
    {
        $mockComponent = new MockComponentPresenter();
        $expectedContent = $mockComponent->present();
        $contentPresenter = new ContentPresenter("booking");
        $contentPresenter->api = $this->mockContentApi;
        $page = $contentPresenter->present();

        $this->assertEquals($expectedContent, $page->content->components[0]);
    }
}
