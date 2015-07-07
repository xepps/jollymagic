<?php

namespace Jollymagic\Page;

class PageController
{
    protected $app;
    protected $config;

    public function __construct(\Silex\Application $app, $config)
    {
        $this->app = $app;
        $this->config = $config;
    }

    public function show($page)
    {
        return $this->app['view-factory'](
            $page,
            array(
                "baseUrl" => $this->app['baseUrl']
            )
        );
    }
}
