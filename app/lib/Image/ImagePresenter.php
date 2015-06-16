<?php

namespace Jollymagic\Image;

use Jollymagic\Presenter;

class ImagePresenter implements Presenter
{

    private $image;
    private $imageDir;
    private $imageExists;

    public function __construct($image, $directory, ImageExistsChecker $imageExists)
    {
        $this->image = $image;
        $this->imageDir = $directory;
        $this->imageExists = $imageExists;
    }

    public function present()
    {
        $imagePath = $this->imageDir.$this->image;
        return $this->imageExists->check($imagePath) ? $imagePath : null;
    }
}
