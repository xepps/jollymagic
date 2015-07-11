<?php

namespace Jollymagic\Content;

class NavItem
{
    public $title;
    public $url;

    public function __construct($title, $url)
    {
        $this->title = $title;
        $this->url = $url;
    }
}
