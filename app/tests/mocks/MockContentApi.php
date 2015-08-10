<?php

namespace Jollymagic\Content;

class MockContentApi implements ContentApi
{
    public $content;
    public $footer;

    public function fetchContent()
    {
        return $this->content;
    }

    public function fetchFooter()
    {
        return $this->footer;
    }
}
