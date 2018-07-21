<?php

namespace Jollymagic\Content;

class Page
{
    public $title;
    public $description;
    public $keywords;
    public $body;
    public $components;
    public $backgroundImage;
    public $displayReview;
    
    public function __construct($title, $description, $keywords, $body, $components, $backgroundImage, $displayReview)
    {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
        $this->body = $body;
        $this->components = $components;
        $this->backgroundImage = $backgroundImage;
        $this->displayReview = $displayReview;
    }
}
