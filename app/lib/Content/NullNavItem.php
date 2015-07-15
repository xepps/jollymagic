<?php

namespace Jollymagic\Content;

class NullNavItem extends NavItem
{
    public $title;
    public $url;

    public function __construct()
    {
        $this->title = null;
        $this->url = null;
    }
}
