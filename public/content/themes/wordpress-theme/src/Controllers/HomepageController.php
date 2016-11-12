<?php

namespace WordpressTheme\Controllers;

use WordpressTheme\View;

class HomepageController
{
    /**
     * Renders the homepage.
     *
     * @return string
     */
    public function render()
    {
        return view('/homepage');
    }
}
