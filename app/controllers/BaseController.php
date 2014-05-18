<?php

class BaseController extends Controller
{

    protected $layout = 'layouts.main';

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (! is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }

        try {
            $this->layout->analytics = View::make('_analytics');
        } catch (InvalidArgumentException $e) {
            $this->layout->analytics = '';
        }

        $this->layout->styles  = HTML::style('/css/main.css');
        $this->layout->scripts = '';
    }
}
