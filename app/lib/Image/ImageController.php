<?php

namespace Jollymagic\Image;

class ImageController
{

    private $app;
    private $config;

    public function __construct(\Silex\Application $app, $config)
    {
        $this->app = $app;
        $this->config = $config;
    }

    public function show($image)
    {
        $imagePresenter = new ImagePresenter(
            $image,
            $this->config['routeDir'].$this->config['imageDir'],
            new FileIoImageExistsChecker()
        );

        $imagePath = $imagePresenter->present();
        if (empty($imagePath)) {
            $this->app->abort(404, "The image was not found");
            return null;
        }

        $stream = function () use ($imagePath) {
            readfile($imagePath);
        };

        return $this->app->stream(
            $stream,
            200,
            array(
                'Content-Type' => 'image/png'
            )
        );
    }
}
