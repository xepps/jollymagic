<?php

namespace Jollymagic\Image;

interface ImageExistsChecker
{
    /***
     * @param $imagePath
     * @return bool
     */
    public function check($imagePath);
}
