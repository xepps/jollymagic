<?php

namespace Jollymagic\Image;

class AlwaysFoundChecker implements ImageExistsChecker
{
    public function check($imagePath)
    {
        return true;
    }
}
