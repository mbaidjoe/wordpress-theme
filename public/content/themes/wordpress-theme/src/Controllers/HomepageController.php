<?php

namespace WordpressTheme\Controllers;

use WordpressTheme\Views\View;

class HomepageController
{
    /**
     * Renders the homepage.
     *
     * @return string
     */
    public function render()
    {
        return (new View())->render('/homepage');
    }
}
