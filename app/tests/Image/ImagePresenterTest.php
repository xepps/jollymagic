<?php

namespace Jollymagic\Image;

class ImagePresenterTest extends \PHPUnit_Framework_TestCase
{

    public function testThatImageCanBeRetrievedFromDirectoryIfFound()
    {
        $image = 'image.png';
        $directory = '/static/images/';
        $expected = '/static/images/image.png';

        $imagePresenter = new ImagePresenter($image, $directory, new AlwaysFoundChecker());
        $imagePath = $imagePresenter->present();

        $this->assertEquals($expected, $imagePath);
    }

    public function testThatImageIsNotRetrievedFromDirectoryIfNotFound()
    {
        $image = 'image.png';
        $directory = '/static/images/';
        $expected = null;

        $imagePresenter = new ImagePresenter($image, $directory, new NeverFoundChecker());
        $imagePath = $imagePresenter->present();

        $this->assertEquals($expected, $imagePath);
    }
}
