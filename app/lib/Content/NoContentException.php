<?php

namespace Jollymagic\Content;

use Exception;

class NoContentException extends Exception
{
    public function __construct($page)
    {
        $message = "Page not found: $page";
        parent::__construct($message, 404);
    }
}
