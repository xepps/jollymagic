<?php

namespace Jollymagic\Image;

class ImagePresenterTest extends \PHPUnit_Framework_TestCase {

    public function testThatImageCanBeRetrievedFromDirectory()
    {
        $image = 'image.png';
        $directory = '/static';
        $expected = '/static/images/image.png';

        $imagePresenter = new ImagePresenter($image, $directory);
        $imagePath = $imagePresenter->present();

        $this->assertEquals($expected, $imagePath);
    }
}
