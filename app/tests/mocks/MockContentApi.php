<?php

namespace Jollymagic\Content;

class MockContentApi implements ContentApi
{
    public $content;

    public function fetchContent()
    {
        return $this->content;
    }
}
