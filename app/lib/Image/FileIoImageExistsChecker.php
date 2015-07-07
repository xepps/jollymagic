<?php

namespace Jollymagic\Image;

class FileIoImageExistsChecker implements ImageExistsChecker
{
    public function check($imagePath)
    {
        return file_exists($imagePath);
    }
}
