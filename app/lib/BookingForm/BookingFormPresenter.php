<?php

namespace Jollymagic\BookingForm;

use Jollymagic\Presenter;
use DOMDocument;
use DOMAttr;

class BookingFormPresenter implements Presenter
{
    public $form;
    public $formName = 'bookingForm';
    private $config;
    private $opts;

    public function __construct($config, $opts = array())
    {
        $this->config = $config;
        $this->opts = $opts;
    }

    /***
     * @returns String
     */
    public function present()
    {
        if (!empty($this->opts)) {
            return print_r($this->opts, true);
        } else {
            $form = $this->getForm();
            return $this->createForm($form);
        }

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

        return trim($dd->saveHTML());
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

        if (isset($input->required) && $input->required) {
            $label->appendChild(
                $this->createAttribute(
                    $domDocument,
                    'class',
                    'required'
                )
            );
        }

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

        if (isset($input->defaultValue)) {
            $textInput->appendChild(
                $this->createAttribute(
                    $domDocument,
                    'placeholder',
                    $input->defaultValue
                )
            );
        }

        if (isset($input->required) && $input->required) {
            $textInput->appendChild(
                $this->createAttribute(
                    $domDocument,
                    'class',
                    'required'
                )
            );
        }

        return $textInput;
    }

    /***
     * @param DOMDocument $domDocument
     * @param $input
     * @return DOMDocument
     */
    private function createTextArea($domDocument, $input)
    {
        $textArea = $domDocument->createElement('textarea');

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

        if (isset($input->defaultValue)) {
            $textArea->appendChild(
                $this->createAttribute(
                    $domDocument,
                    'placeholder',
                    $input->defaultValue
                )
            );
        }

        if (isset($input->required) && $input->required) {
            $textArea->appendChild(
                $this->createAttribute(
                    $domDocument,
                    'class',
                    'required'
                )
            );
        }

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
                $this->formName
            )
        );
        $submitButton->appendChild(
            $this->createAttribute(
                $domDocument,
                'id',
                $this->formName
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
                $this->config['routeDir'].
                $this->config['contentDir'].
                'bookingForm.json'
            )
        );
    }
}
