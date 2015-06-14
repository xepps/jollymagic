<?php

// web/index.php
require_once __DIR__ . '/../../vendor/autoload.php';

$app = new Silex\Application();

\Symfony\Component\Debug\ErrorHandler::register();
\Symfony\Component\Debug\ExceptionHandler::register();

// ...definitions ?
$app->register(new Jollymagic\ServiceProvider());
$app['debug'] = true;

require 'routes.php';

$app->run();
