<?php

namespace Jollymagic\Components;

class BookingFormPresenterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider inputProvider
     */
    public function testThatItGeneratesAllTheRequiredFormInputsFromConfig($input, $expected)
    {
        $bookingForm = new BookingFormPresenter(null);
        $bookingForm->form = $input;
        $renderedHtml = $bookingForm->present();
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
                '<label for="test">Test Item</label>' .
                '<input type="text" name="test" id="test" value="default">' .
                '</form>'
            )
        );
    }
}
