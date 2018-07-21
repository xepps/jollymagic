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

    public function show($page = 'index', $opts = array())
    {
        $model = $this->getModel($page, $opts);

        return $this->app['view-factory'](
            'index',
            array(
                "baseUrl" => $this->app["request"]->getBaseUrl(),
                "content" => $model->content,
                "review" => $model->review,
                "footer" => $model->footer,
                "nav" => $model->nav
            ),
            $model->statusCode
        );
    }

    private function getModel($page, $opts)
    {
        try {
            return $this->app['content-controller']->show($page, $opts);
        } catch (NoContentException $e) {
            return $this->app['content-controller']->show404Page();
        }
    }
}
