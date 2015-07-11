<?php

namespace Jollymagic\Content;

class ContentPresenter
{
    public function show($page)
    {
        $data = $this->getApi()->fetchContent();

        return (object) array(
            'content' => $this->buildPageContents($page, $data),
            'nav' => $this->buildNav($data)
        );
    }

    public function setApi($api)
    {
        $this->_api = $api;
    }

    /***
     * @param $page
     * @param $data
     * @return Page
     */
    private function buildPageContents($page, $data)
    {
        $pageData = $data[$page];
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
        return array_map(
            function ($page) {
                return new NavItem($page->navTitle, $page->url);
            },
            $data
        );
    }

    /***
     * @return ContentApi
     */
    private function getApi()
    {
        return $this->_api ?: new FileBasedContentApi();
    }
}
