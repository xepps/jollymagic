<?php

namespace Jollymagic\BookingForm;

use Symfony\Component\HttpFoundation\Request;

class BookingFormHandler
{

    public $form;
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    /***
     * @param Request $request
     * @return Object
     */
    public function handle($request)
    {
        $response = $this->createBlankResponse();

        foreach ($this->getForm()->inputs as $input) {

            $response->{$input->name} = $request->get($input->name);

            if ($this->isRequiredButNotSet($input, $response->{$input->name})) {
                $response->success = false;
                $response->errors []= $input->name;
            }

        }
        return $response;
    }

    private function getForm()
    {
        return $this->form ?: json_decode(
            file_get_contents(
                $this->config['routeDir'].
                $this->config['contentDir'].
                'bookingForm.json'
            )
        );
    }

    private function isRequiredButNotSet($input, $value)
    {
        return isset($input->required) && $input->required && empty($value);
    }

    private function createBlankResponse()
    {
        return (object) array(
            "success" => true,
            "errors" => []
        );
    }
}
