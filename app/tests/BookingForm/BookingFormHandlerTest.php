<?php

namespace Jollymagic\BookingForm;

use Symfony\Component\HttpFoundation\Request;

class BookingFormHandlerTest extends \PHPUnit_Framework_TestCase
{

    public function setUpRequest($responses)
    {
        return new Request($responses);
    }

    /**
     * @dataProvider completedResponseProvider
     */
    public function testHandlesRequest($form, $input, $expected)
    {
        $request = $this->setUpRequest($input);
        $handler = new BookingFormHandler(null);
        $handler->form = $form;
        $result = $handler->handle($request);
        $this->assertEquals($expected, $result);
    }

    public function completedResponseProvider()
    {
        return array(
            array(
                // form
                (object) array(
                    'method' => 'post',
                    'inputs' => array(
                        (object) array(
                            "type" => "text",
                            "name" => "test",
                            "title" => "Test Item",
                            "required" => true
                        )
                    )
                ),
                // input,
                array(
                    "test" => 'hello'
                ),
                //expected
                (object) array(
                    "success" => true,
                    "errors" => [],
                    "test" => "hello"
                )
            )
        );
    }
}
