<?php

namespace Jollymagic\Content;

class FileBasedContentApi implements ContentApi
{
    private $contentDir;

    public function __construct($contentDir)
    {
        $this->contentDir = $contentDir;
    }

    public function fetchContent()
    {
        return json_decode(
            file_get_contents(
                $this->contentDir.'site.json'
            )
        );
    }
}
