<?php

namespace Jollymagic\Components;

use Jollymagic\Presenter;
use DOMDocument;

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
        $formMethod = $dd->createAttribute('method');
        $formMethod->value = $form->method;
        $formTag->appendChild($formMethod);

        foreach ($form->inputs as $input) {
            $label = $dd->createElement('label', $input->title);
            $labelFor = $dd->createAttribute('for');
            $labelFor->value = $input->name;
            $label->appendChild($labelFor);

            $tag = $dd->createElement('input');

            $tagType = $dd->createAttribute('type');
            $tagType->value = $input->type;
            $tag->appendChild($tagType);

            $tagName = $dd->createAttribute('name');
            $tagName->value = $input->name;
            $tag->appendChild($tagName);

            $tagId = $dd->createAttribute('id');
            $tagId->value = $input->name;
            $tag->appendChild($tagId);

            $tagValue = $dd->createAttribute('value');
            $tagValue->value = $input->defaultValue;
            $tag->appendChild($tagValue);

            $formTag->appendChild($label);
            $formTag->appendChild($tag);
        }

        $dd->appendChild($formTag);

        return $dd->saveHTML();
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
