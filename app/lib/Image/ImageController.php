<?php

namespace Jollymagic\Image;

class ImageController {

    private $_app;

    public function __construct(\Silex\Application $app) {
        $this->_app = $app;
    }

    public function show($image) {
        $imagePresenter = new ImagePresenter($image);
        return $imagePresenter->present();
    }
}
