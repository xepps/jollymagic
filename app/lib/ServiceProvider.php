<?php

namespace Jollymagic;

use Jollymagic\Page\PageController;
use Jollymagic\Image\ImageController;
use Silex\Application;
use Silex\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['config'] = function () {
            return include 'config/config.php';
        };

        $app['page-controller'] = function ($app) {
            return new PageController(
                $app,
                $app['config']
            );
        };

        $app['image-controller'] = function ($app) {
            return new ImageController(
                $app,
                $app['config']
            );
        };

        $app['view-factory'] = function () {
            return function ($viewName, $viewArgs = array(), $statusCode = 200, $headers = array()) {
                $viewPath = __DIR__ . '/views/' . $viewName . '.php';
                return new ViewResponse($viewPath, $viewArgs, $statusCode, $headers);
            };
        };
    }

    public function boot(Application $app)
    {
    }
}
