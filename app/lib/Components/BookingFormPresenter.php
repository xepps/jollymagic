<?php

namespace Jollymagic\Components;

use Jollymagic\Presenter;
use DOMDocument;
use DOMAttr;

class BookingFormPresenter implements Presenter
{
    public $form;
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    /***
     * @returns String
     */
    public function present()
    {
        $form = $this->getForm();
        return trim(
            $this->createForm($form)
        );
    }

    private function createForm($form)
    {
        $dd = new DOMDocument();
        $formTag = $dd->createElement('form');
        $formTag->appendChild(
            $this->createAttribute(
                $dd,
                'method',
                $form->method
            )
        );

        foreach ($form->inputs as $input) {
            switch ($input->type) {
                case 'text':
                    $formTag->appendChild($this->createLabel($dd, $input));
                    $formTag->appendChild($this->createTextInput($dd, $input));
                    break;
                case 'textarea':
                    $formTag->appendChild($this->createLabel($dd, $input));
                    $formTag->appendChild($this->createTextArea($dd, $input));
                    break;
                case 'submit':
                    $formTag->appendChild($this->createSubmitButton($dd, $input));
                    break;
                case 'default':
                    break;
            }
        }

        $dd->appendChild($formTag);

        return $dd->saveHTML();
    }

    /***
     * @param DOMDocument $domDocument
     * @param $input
     * @return DOMDocument
     */
    private function createLabel($domDocument, $input)
    {
        $label = $domDocument->createElement('label', $input->title);
        $labelFor = $domDocument->createAttribute('for');
        $labelFor->value = $input->name;
        $label->appendChild($labelFor);

        return $label;
    }

    /***
     * @param DOMDocument $domDocument
     * @param $input
     * @return DOMDocument
     */
    private function createTextInput($domDocument, $input)
    {
        $textInput = $domDocument->createElement('input');

        $textInput->appendChild(
            $this->createAttribute(
                $domDocument,
                'type',
                $input->type
            )
        );
        $textInput->appendChild(
            $this->createAttribute(
                $domDocument,
                'name',
                $input->name
            )
        );
        $textInput->appendChild(
            $this->createAttribute(
                $domDocument,
                'id',
                $input->name
            )
        );
        $textInput->appendChild(
            $this->createAttribute(
                $domDocument,
                'value',
                $input->defaultValue
            )
        );

        return $textInput;
    }

    /***
     * @param DOMDocument $domDocument
     * @param $input
     * @return DOMDocument
     */
    private function createTextArea($domDocument, $input)
    {
        $textArea = $domDocument->createElement('textarea', $input->defaultValue);

        $textArea->appendChild(
            $this->createAttribute(
                $domDocument,
                'id',
                $input->name
            )
        );
        $textArea->appendChild(
            $this->createAttribute(
                $domDocument,
                'name',
                $input->name
            )
        );

        return $textArea;
    }

    /***
     * @param DOMDocument $domDocument
     * @param $input
     * @return DOMDocument
     */
    private function createSubmitButton($domDocument, $input)
    {
        $submitButton = $domDocument->createElement('input');

        $submitButton->appendChild(
            $this->createAttribute(
                $domDocument,
                'type',
                $input->type
            )
        );
        $submitButton->appendChild(
            $this->createAttribute(
                $domDocument,
                'value',
                $input->title
            )
        );
        $submitButton->appendChild(
            $this->createAttribute(
                $domDocument,
                'name',
                $input->name
            )
        );
        $submitButton->appendChild(
            $this->createAttribute(
                $domDocument,
                'id',
                $input->name
            )
        );

        return $submitButton;
    }

    /***
     * @param DOMDocument $domDocument
     * @param $name
     * @param $value
     * @return DOMAttr
     */
    private function createAttribute($domDocument, $name, $value)
    {
        $attr = $domDocument->createAttribute($name);
        $attr->value = $value;
        return $attr;
    }

    private function getForm()
    {
        return $this->form ?: json_decode(
            file_get_contents(
                $this->config['contentDir'].'bookingForm.json'
            )
        );
    }
}
