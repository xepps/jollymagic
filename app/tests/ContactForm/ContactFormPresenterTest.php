<?php

namespace Jollymagic\ContactForm;

class ContactFormPresenterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider inputProvider
     */
    public function testThatItGeneratesAllTheRequiredFormInputsFromConfig($input, $expected)
    {
        $contactForm = new ContactFormPresenter(null);
        $contactForm->form = $input;
        $contactForm->formName = 'formyForm';
        $renderedHtml = $contactForm->present();
        $this->assertEquals($expected, $renderedHtml);
    }

    /**
     * @dataProvider responseInputProvider
     */
    public function testThatInputsShowCompletedValuesFromResponse($input, $response, $expected)
    {
        $contactForm = new ContactFormPresenter(null, $response);
        $contactForm->form = $input;
        $contactForm->formName = 'formyForm';
        $renderedHtml = $contactForm->present();
        $this->assertEquals($expected, $renderedHtml);
    }

    /**
     * @dataProvider failureInputProvider
     */
    public function testThatInputsThatFailRequirementAddClassToInput($input, $response, $expected)
    {
        $contactForm = new ContactFormPresenter(null, $response);
        $contactForm->form = $input;
        $contactForm->formName = 'formyForm';
        $renderedHtml = $contactForm->present();
        $this->assertEquals($expected, $renderedHtml);
    }

    public function inputProvider()
    {
        return array(
            array(
                (object) array(
                    'method' => 'post',
                    'inputs' => array(
                        (object) array(
                            "type" => "text",
                            "name" => "test",
                            "title" => "Test Item",
                            "defaultValue" => "default"
                        )
                    )
                ),
                '<form method="post">' .
                '<label for="test" class="">Test Item</label>' .
                '<input type="text" name="test" id="test" class="" placeholder="default" value="">' .
                '</form>'
            ),
            array(
                (object) array(
                    'method' => 'post',
                    'inputs' => array(
                        (object) array(
                            "type" => "tel",
                            "name" => "test",
                            "title" => "Test Item",
                            "defaultValue" => "default"
                        )
                    )
                ),
                '<form method="post">' .
                '<label for="test" class="">Test Item</label>' .
                '<input type="tel" name="test" id="test" class="" placeholder="default" value="">' .
                '</form>'
            ),
            array(
                (object) array(
                    'method' => 'post',
                    'inputs' => array(
                        (object) array(
                            "type" => "email",
                            "name" => "test",
                            "title" => "Test Item",
                            "defaultValue" => "default"
                        )
                    )
                ),
                '<form method="post">' .
                '<label for="test" class="">Test Item</label>' .
                '<input type="email" name="test" id="test" class="" placeholder="default" value="">' .
                '</form>'
            ),
            array(
                (object) array(
                    'method' => 'post',
                    'inputs' => array(
                        (object) array(
                            "type" => "text",
                            "name" => "test",
                            "title" => "Test Item",
                        )
                    )
                ),
                '<form method="post">' .
                '<label for="test" class="">Test Item</label>' .
                '<input type="text" name="test" id="test" class="" placeholder="" value="">' .
                '</form>'
            ),
            array(
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
                '<form method="post">' .
                '<label for="test" class="required">Test Item</label>' .
                '<input type="text" name="test" id="test" class="required" placeholder="" value="">' .
                '</form>'
            ),
            array(
                (object) array(
                    'method' => 'get',
                    'inputs' => array(
                        (object) array(
                            'type' => 'textarea',
                            'name' => 'test',
                            'title' => 'test text area',
                            'defaultValue' => 'default text'
                        )
                    )
                ),
                '<form method="get">' .
                '<label for="test" class="">test text area</label>' .
                '<textarea id="test" name="test" class="" placeholder="default text"></textarea>' .
                '</form>'
            ),
            array(
                (object) array(
                    'method' => 'get',
                    'inputs' => array(
                        (object) array(
                            'type' => 'textarea',
                            'name' => 'test',
                            'title' => 'test text area',
                            'defaultValue' => 'default text',
                            'required' => true
                        )
                    )
                ),
                '<form method="get">' .
                '<label for="test" class="required">test text area</label>' .
                '<textarea id="test" name="test" class="required" placeholder="default text"></textarea>' .
                '</form>'
            ),
            array(
                (object) array(
                    'method' => 'get',
                    'inputs' => array(
                        (object) array(
                            'type' => 'textarea',
                            'name' => 'test',
                            'title' => 'test text area',
                        )
                    )
                ),
                '<form method="get">' .
                '<label for="test" class="">test text area</label>' .
                '<textarea id="test" name="test" class="" placeholder=""></textarea>' .
                '</form>'
            ),
            array(
                (object) array(
                    'method' => 'post',
                    'inputs' => array(
                        (object) array(
                            'type' => 'submit',
                            'title' => 'title'
                        )
                    )
                ),
                '<form method="post">' .
                '<input type="submit" value="title" name="formyForm" id="formyForm">' .
                '</form>'
            ),
            array(
                (object) array(
                    'method' => 'post',
                    'inputs' => array(
                        (object) array(
                            "type" => "text",
                            "name" => "test1",
                            "title" => "Test Item1",
                            "defaultValue" => "default1",
                            "required" => true
                        ),
                        (object) array(
                            "type" => "text",
                            "name" => "test2",
                            "title" => "Test Item2",
                            "defaultValue" => "default2"
                        ),
                        (object) array(
                            'type' => 'textarea',
                            'name' => 'test',
                            'title' => 'test text area',
                            'defaultValue' => 'default text'
                        ),
                        (object) array(
                            'type' => 'submit',
                            'title' => 'title'
                        )
                    )
                ),
                '<form method="post">' .
                '<label for="test1" class="required">Test Item1</label>' .
                '<input type="text" name="test1" id="test1" class="required" placeholder="default1" value="">' .
                '<label for="test2" class="">Test Item2</label>' .
                '<input type="text" name="test2" id="test2" class="" placeholder="default2" value="">' .
                '<label for="test" class="">test text area</label>' .
                '<textarea id="test" name="test" class="" placeholder="default text"></textarea>' .
                '<input type="submit" value="title" name="formyForm" id="formyForm">' .
                '</form>'
            )
        );
    }

    public function responseInputProvider()
    {
        return array(
            array(
                // input
                (object) array(
                    'method' => 'post',
                    'inputs' => array(
                        (object) array(
                            "type" => "text",
                            "name" => "test",
                            "title" => "Test Item",
                        )
                    )
                ),
                // response
                (object) array(
                    'success' => false,
                    'errors' => [],
                    'test' => 'result'
                ),

                // expected
                '<form method="post">' .
                '<label for="test" class="">Test Item</label>' .
                '<input type="text" name="test" id="test" class="" placeholder="" value="result">' .
                '</form>'
            ),
            array(
                // input
                (object) array(
                    'method' => 'get',
                    'inputs' => array(
                        (object) array(
                            'type' => 'textarea',
                            'name' => 'test',
                            'title' => 'test text area',
                            'defaultValue' => 'default text'
                        )
                    )
                ),
                // response
                (object) array(
                    'success' => false,
                    'errors' => [],
                    'test' => 'result'
                ),

                // expected
                '<form method="get">' .
                '<label for="test" class="">test text area</label>' .
                '<textarea id="test" name="test" class="" placeholder="default text">result</textarea>' .
                '</form>'
            )
        );
    }

    public function failureInputProvider()
    {
        return array(
            array(
                // input
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
                // response
                (object) array(
                    'success' => false,
                    'errors' => [
                        'test'
                    ],
                    'test' => ''
                ),

                // expected
                '<form method="post">' .
                '<label for="test" class="required failedValidation">Test Item</label>' .
                '<input type="text" name="test" id="test" class="required failedValidation" placeholder="" value="">' .
                '</form>'
            ),
            array(
                // input
                (object) array(
                    'method' => 'get',
                    'inputs' => array(
                        (object) array(
                            'type' => 'textarea',
                            'name' => 'test',
                            'title' => 'test text area',
                            'defaultValue' => 'default text',
                            'required' => true
                        )
                    )
                ),
                // response
                (object) array(
                    'success' => false,
                    'errors' => [
                        'test'
                    ],
                    'test' => ''
                ),

                // expected
                '<form method="get">' .
                '<label for="test" class="required failedValidation">test text area</label>' .
                '<textarea id="test" name="test" class="required failedValidation" placeholder="default text">' .
                '</textarea>' .
                '</form>'
            )
        );
    }
}
