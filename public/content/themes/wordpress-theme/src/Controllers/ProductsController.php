<?php

namespace WordpressTheme\Controllers;

use WordpressTheme\View;

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
        return view('/products/single');
    }

    /**
     * Renders the archive page.
     *
     * @return string
     */
    public function archive()
    {
        return view('/products/archive');
    }
}
