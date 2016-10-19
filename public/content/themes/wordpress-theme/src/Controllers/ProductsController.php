<?php

namespace WordpressTheme\Controllers;

use WordpressTheme\Views\View;

class ProductsController
{
    /**
     * Renders the single page.
     *
     * @param  string $slug
     * @return string
     */
    public function single($slug)
    {
        return (new View())->render('/products/single');
    }

    /**
     * Renders the archive page.
     *
     * @return string
     */
    public function archive()
    {
        return (new View())->render('/products/archive');
    }
}
