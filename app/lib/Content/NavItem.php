<?php

namespace Jollymagic\Content;

class NavItem
{
    public $navTitle;
    public $url;

    public function __construct($navTitle, $url)
    {
        $this->navTitle = $navTitle;
        $this->url = $url;
    }
}
