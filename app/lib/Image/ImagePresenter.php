<?php

namespace Jollymagic\Image;

use Presenter;

class ImagePresenter implements Presenter {

    public function __construct($image, $directory = __DIR__) {
        $this->_image = $image;
        $this->_dir = $directory;
    }

    public function present() {
        return "$this->_dir/images/$this->_image";
    }
}
