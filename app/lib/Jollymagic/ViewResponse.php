<?php

namespace Jollymagic;

class ViewResponse extends \Symfony\Component\HttpFoundation\Response
{
    protected $_viewPath;
    protected $_viewArgs;

    /**
     * @param string $viewPath The path to the view File
     * @param array  $viewArgs Parameters available in the view
     * @param int    $statusCode
     * @param array  $headers
     */
    public function __construct($viewPath, $viewArgs, $statusCode = 200, $headers = array()) {
        parent::__construct('', $statusCode, $headers);
        $this->_viewPath = $viewPath;
        $this->_viewArgs = $viewArgs;
    }

    public function prepare(\Symfony\Component\HttpFoundation\Request $request) {
        if (empty($this->content)) {
            $this->setContent($this->render());
        }
        parent::prepare($request);
    }

    public function getContent() {
        if (empty($this->content)) {
            $this->setContent($this->render());
        }
        return parent::getContent();
    }

    public function getViewArgs() {
        return $this->_viewArgs;
    }

    protected function render() {
        ob_start();
        extract($this->_viewArgs);

        require $this->_viewPath;

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }
}
