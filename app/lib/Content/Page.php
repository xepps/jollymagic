<?php

namespace Jollymagic\Content;

class Page
{
    public $title;
    public $body;
    public $backgroundImage;

    public function __construct($title, $body, $backgroundImage)
    {
        $this->title = $title;
        $this->body = $body;
        $this->backgroundImage = $backgroundImage;
    }
}
