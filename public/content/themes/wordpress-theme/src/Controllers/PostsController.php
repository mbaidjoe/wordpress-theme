<?php

namespace WordpressTheme\Controllers;

use WordpressTheme\View;

class PostsController
{
    /**
     * Renders a single page.
     *
     * @param  string $slug
     * @return string
     */
    public function render($slug)
    {
        return view('/posts/single');
    }
}
