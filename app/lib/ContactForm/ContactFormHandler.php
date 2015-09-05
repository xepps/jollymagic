<?php

namespace Jollymagic\ContactForm;

use Symfony\Component\HttpFoundation\Request;

class ContactFormHandler
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
        $response = $this->generateResponseFromRequest($request);
        $this->sendMail($response);
        return $response;
    }

    private function getForm()
    {
        return $this->form ?: json_decode(
            file_get_contents(
                $this->config['routeDir'].
                $this->config['contentDir'].
                'contactForm.json'
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

    /**
     * @param Request $request
     * @return object
     */
    private function generateResponseFromRequest($request)
    {
        $response = $this->createBlankResponse();

        foreach ($this->getForm()->inputs as $input) {

            if (!isset($input->name)) {
                continue;
            }

            $response->{$input->name} = $request->get($input->name);

            if ($this->isRequiredButNotSet($input, $response->{$input->name})) {
                $response->success = false;
                $response->errors [] = $input->name;
            }

        }
        return $response;
    }

    private function sendMail($response)
    {
        $mail = "Hi Alan\n\nA potential client has just submitted the following details through your website:\n\n";
        foreach ((array) $response as $key => $value) {
            if (is_string($value)) {
                $mail .= " - $key: $value\n";
            }
        }
        $mail .= "\n\nThank you";
        mail('info@jollymagic.com', 'Result from jollymagic.com', $mail, "From: automail@jollymagic.com");
    }
}
