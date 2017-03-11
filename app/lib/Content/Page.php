<?php

namespace Jollymagic\Content;

class Page
{
    public $title;
    public $description;
    public $body;
    public $components;
    public $backgroundImage;

    public function __construct($title, $description, $body, $components, $backgroundImage)
    {
        $this->title = $title;
        $this->description = $description;
        $this->body = $body;
        $this->components = $components;
        $this->backgroundImage = $backgroundImage;
    }
}
