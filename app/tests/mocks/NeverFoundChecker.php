<?php

namespace Jollymagic\Image;

class NeverFoundChecker implements ImageExistsChecker
{
    public function check($imagePath)
    {
        return false;
    }
}
