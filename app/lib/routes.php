<?php

use Symfony\Component\HttpFoundation\Request;

$app->get(
    '/status',
    function () {
        return 'OK';
    }
);

$app->get(
    '/{page}',
    function (Silex\Application $app, $page) {
        return $app['page-controller']->show($page);
    }
);

$app->post(
    '/booking',
    function (Silex\Application $app, Request $request) {
        var_dump($request->get('phone-number'));die;
        return $app['page-controller']->show('booking');
    }
);

$app->get(
    '',
    function (Silex\Application $app) {
        return $app['page-controller']->show('index');
    }
);

$app->get(
    '/image/{image}',
    function (Silex\Application $app, $image) {
        return $app['image-controller']->show($image);
    }
);
