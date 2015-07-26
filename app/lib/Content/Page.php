<?php

namespace Jollymagic\Content;

class Page
{
    public $title;
    public $body;
    public $components;
    public $backgroundImage;

    public function __construct($title, $body, $components, $backgroundImage)
    {
        $this->title = $title;
        $this->body = $body;
        $this->components = $components;
        $this->backgroundImage = $backgroundImage;
    }
}
