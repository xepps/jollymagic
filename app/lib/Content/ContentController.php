<?php

namespace Jollymagic\Content;

class ContentController
{
    private $app;
    private $config;

    public function __construct(\Silex\Application $app, $config)
    {
        $this->app = $app;
        $this->config = $config;
    }

    public function show($page)
    {
        $contentPresenter = new ContentPresenter($page);
        $contentPresenter->setApi(
            new FileBasedContentApi(
                $this->config['routeDir'].$this->config['contentDir']
            )
        );
        return $contentPresenter->present();
    }
}
