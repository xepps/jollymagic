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
        $contentPresenter = new ContentPresenter($page, $this->config);
        $contentPresenter->api = new FileBasedContentApi(
            $this->config['routeDir'].$this->config['contentDir']
        );
        return $contentPresenter->present();
    }

    public function show404Page()
    {
        $content = $this->show('404');
        $content->statusCode = 404;
        return $content;
    }
}
