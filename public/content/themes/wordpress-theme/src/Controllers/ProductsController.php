<?php

namespace WordpressTheme\Controllers;

use WordpressTheme\Views\HtmlView;

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
        return (new HtmlView())->renderPage('/products/single');
    }

    /**
     * Renders the archive page.
     *
     * @return string
     */
    public function archive()
    {
        return (new HtmlView())->renderPage('/products/archive');
    }
}
