<?php

namespace Jollymagic\Components;

use Jollymagic\Presenter;

class MockComponentPresenter implements Presenter
{
    public function present()
    {
        return '<form><input><submit></form>';
    }
}
