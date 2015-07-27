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
            $formTag->appendChild($this->createLabel($dd, $input));
            $formTag->appendChild($this->createInput($dd, $input));
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
    private function createInput($domDocument, $input)
    {
        $inputTag = $domDocument->createElement('input');

        $inputTag->appendChild(
            $this->createAttribute(
                $domDocument,
                'type',
                $input->type
            )
        );
        $inputTag->appendChild(
            $this->createAttribute(
                $domDocument,
                'name',
                $input->name
            )
        );
        $inputTag->appendChild(
            $this->createAttribute(
                $domDocument,
                'id',
                $input->name
            )
        );
        $inputTag->appendChild(
            $this->createAttribute(
                $domDocument,
                'value',
                $input->defaultValue
            )
        );

        return $inputTag;
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
