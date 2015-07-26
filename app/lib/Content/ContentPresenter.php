<?php

namespace Jollymagic\Content;

use Jollymagic\Presenter;

class ContentPresenter implements Presenter
{
    /***
     * @var ContentApi
     */
    public $api;
    private $page;

    public function __construct($page)
    {
        $this->page = $page;
    }

    public function present()
    {
        $data = $this->api->fetchContent();

        return (object) array(
            'content' => $this->buildPageContents($this->page, $data),
            'nav' => $this->buildNav($data),
            'statusCode' => 404
        );
    }

    /***
     * @param $page
     * @param $data
     * @return Page
     */
    private function buildPageContents($page, $data)
    {
        if (empty($data->{$page})) {
            throw new NoContentException($page);
        }

        $pageData = $data->{$page};

        return new Page(
            $pageData->title,
            $this->convertBodyToHtml($pageData->bodyText),
            $this->renderComponents($pageData->components),
            $pageData->backgroundImage
        );
    }

    /***
     * @param $data
     * @return NavItem[]
     */
    private function buildNav($data)
    {
        $data = (array) $data;
        return array_map(
            function ($page) {
                if (empty($page->navTitle) || empty($page->url)) {
                    return new NullNavItem();
                }

                return new NavItem($page->navTitle, $page->url);
            },
            $data
        );
    }

    /***
     * @param $bodyText
     * @return String
     */
    private function convertBodyToHtml($bodyText)
    {
        if (empty($bodyText)) {
            return '';
        }

        $pd = new \Parsedown();
        return array_reduce(
            $bodyText,
            function ($carry, $paragraph) use ($pd) {
                return $carry . $pd->text($paragraph);
            },
            ''
        );
    }

    /***
     * @param String[]
     * @return Array
     */
    private function renderComponents($components)
    {
        if (empty($components)) {
            return array();
        }

        return array_map(
            function ($componentName) {
                $component = new $componentName();
                return $component->present();
            },
            $components
        );
    }
}
