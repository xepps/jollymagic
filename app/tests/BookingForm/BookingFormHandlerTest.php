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
            ),
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
                    "test" => ''
                ),
                //expected
                (object) array(
                    "success" => false,
                    "errors" => [
                        'test'
                    ],
                    "test" => ""
                )
            ),
            array(
                // form
                (object) array(
                    'method' => 'post',
                    'inputs' => array(
                        (object) array(
                            "type" => "text",
                            "name" => "test",
                            "title" => "Test Item",
                            "required" => false
                        )
                    )
                ),
                // input,
                array(
                    "test" => ''
                ),
                //expected
                (object) array(
                    "success" => true,
                    "errors" => [],
                    "test" => ""
                )
            ),
            array(
                // form
                (object) array(
                    'method' => 'post',
                    'inputs' => array(
                        (object) array(
                            "type" => "text",
                            "name" => "test",
                            "title" => "Test Item",
                            "required" => false
                        ),
                        (object) array(
                            "type" => "textarea",
                            "name" => "testarea",
                            "title" => "Test Item2",
                            "required" => true
                        ),
                        (object) array(
                            "type" => "text",
                            "name" => "test2",
                            "title" => "Test Item4",
                            "required" => false
                        ),
                        (object) array(
                            "type" => "submit",
                            "title" => "send",
                        )
                    )
                ),
                // input,
                array(
                    "test" => 'hi',
                    "testarea" => 'hello',
                    "test2" => 'sup',
                    "bookingForm" => 'send'
                ),
                //expected
                (object) array(
                    "success" => true,
                    "errors" => [],
                    "test" => 'hi',
                    "testarea" => 'hello',
                    "test2" => 'sup',
                )
            ),
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
                        ),
                        (object) array(
                            "type" => "textarea",
                            "name" => "testarea",
                            "title" => "Test Item2",
                            "required" => true
                        ),
                        (object) array(
                            "type" => "text",
                            "name" => "test2",
                            "title" => "Test Item4",
                            "required" => true
                        ),
                        (object) array(
                            "type" => "submit",
                            "title" => "send",
                        )
                    )
                ),
                // input,
                array(
                    "test" => 'hi',
                    "testarea" => '',
                    "test2" => '',
                    "bookingForm" => 'send'
                ),
                //expected
                (object) array(
                    "success" => false,
                    "errors" => [
                        'testarea',
                        'test2'
                    ],
                    "test" => 'hi',
                    "testarea" => '',
                    "test2" => '',
                )
            )
        );
    }
}
