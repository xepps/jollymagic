<?php

namespace Jollymagic\ContactForm;

use DOMElement;
use Jollymagic\Presenter;
use DOMDocument;
use DOMAttr;

class ContactFormPresenter implements Presenter
{
    public $form;
    public $formName = 'contactForm';
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
        $form = $this->getForm();
        return $this->createForm($form);
    }

    private function createForm($form)
    {
        $dd = new DOMDocument();
        $formTag = $dd->createElement('form');
        $formTag->appendChild($this->createAttribute($dd, 'class', 'contact-form'));
        $formTag->appendChild($this->createAttribute($dd, 'method', $form->method));

        foreach ($form->inputs as $input) {
            switch ($input->type) {
                case 'text':
                case 'tel':
                case 'email':
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

        $class = isset($input->required) && $input->required ? 'required' : '';
        $class .= isset($this->opts->errors) && in_array($input->name, $this->opts->errors) ? ' failedValidation' : '';

        $label->appendChild($this->createAttribute($domDocument, 'class', $class));

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

        $class = isset($input->required) && $input->required ? 'required' : '';
        $class .= isset($this->opts->errors) && in_array($input->name, $this->opts->errors) ? ' failedValidation' : '';

        return $this->addAttributes(
            $domDocument,
            $textInput,
            array(
                'type' => $input->type,
                'name' => $input->name,
                'id' => $input->name,
                'class' => $class,
                'placeholder' => isset($input->placeholder) ? $input->placeholder : '',
                'value' => isset($this->opts->{$input->name}) ? $this->opts->{$input->name} : ''
            )
        );
    }

    /***
     * @param DOMDocument $domDocument
     * @param $input
     * @return DOMDocument
     */
    private function createTextArea($domDocument, $input)
    {
        $value = isset($this->opts->{$input->name}) ? $this->opts->{$input->name} : '';
        $textArea = $domDocument->createElement('textarea', $value);

        $class = isset($input->required) && $input->required ? 'required' : '';
        $class .= isset($this->opts->errors) && in_array($input->name, $this->opts->errors) ? ' failedValidation' : '';

        return $this->addAttributes(
            $domDocument,
            $textArea,
            array(
                'id' => $input->name,
                'name' => $input->name,
                'class' => $class,
                'placeholder' => isset($input->placeholder) ? $input->placeholder : ''
            )
        );
    }

    /***
     * @param DOMDocument $domDocument
     * @param $input
     * @return DOMDocument
     */
    private function createSubmitButton($domDocument, $input)
    {
        $submitButton = $domDocument->createElement('button', $input->title);

        return $this->addAttributes(
            $domDocument,
            $submitButton,
            array(
                'type' => $input->type,
                'name' => $this->formName,
                'id' => $this->formName
            )
        );
    }

    /***
     * @param DOMDocument $domDocument
     * @param DOMElement $input
     * @param array $kvs
     * @return DOMElement
     */
    private function addAttributes($domDocument, $input, $kvs)
    {
        foreach ($kvs as $key => $value) {
            $input->appendChild($this->createAttribute($domDocument, $key, $value));
        }
        return $input;
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
            file_get_contents($this->config['routeDir'].$this->config['contentDir'].'contactForm.json')
        );
    }
}
