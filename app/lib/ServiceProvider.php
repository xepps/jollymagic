<?php

namespace Jollymagic;

use Jollymagic\BookingForm\BookingFormHandler;
use Jollymagic\Content\ContentController;
use Jollymagic\Page\PageController;
use Jollymagic\Image\ImageController;
use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Request;

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

        $app['content-controller'] = function ($app) {
            return new ContentController(
                $app,
                $app['config']
            );
        };

        $app['booking-form-handler'] = function ($app) {
            return new BookingFormHandler(
                $app['config']
            );
        };

        $app->before(function (Request $request) use ($app) {
            $app['baseUrl'] = 'http://'.$request->getHttpHost();
        });
    }

    public function boot(Application $app)
    {
    }
}
