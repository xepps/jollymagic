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

    public function fetchReviews()
    {
        return json_decode(
            file_get_contents(
                $this->contentDir.'reviews.json'
            )
        );
    }

    public function fetchFooter()
    {
        return json_decode(
            file_get_contents(
                $this->contentDir.'footer.json'
            )
        );
    }
}
