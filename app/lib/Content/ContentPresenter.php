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
            'nav' => $this->buildNav($data)
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
            $pageData->body,
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
                return new NavItem($page->navTitle, $page->url);
            },
            $data
        );
    }
}
