<?php

namespace Jollymagic\Page;

use Jollymagic\Content\NoContentException;

class PageController
{
    protected $app;
    protected $config;

    public function __construct(\Silex\Application $app, $config)
    {
        $this->app = $app;
        $this->config = $config;
    }

    public function show($page = 'index')
    {
        $model = $this->getModel($page);

        return $this->app['view-factory'](
            'index',
            array(
                "baseUrl" => $this->app['baseUrl'],
                "content" => $model->content,
                "nav" => $model->nav
            ),
            $model->statusCode
        );
    }

    private function getModel($page)
    {
        try {
            return $this->app['content-controller']->show($page);
        } catch (NoContentException $e) {
            return $this->app['content-controller']->show404Page();
        }
    }
}
