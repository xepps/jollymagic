<?php

namespace Jollymagic\Page;

class PageController {

    protected $_app;
    protected $_config;

    public function __construct(\Silex\Application $app, $config) {
        $this->_app = $app;
        $this->_config = $config;
    }

    public function show($page) {
        return $this->_app['view-factory'](
            $page,
            array(
            )
        );
    }
}
