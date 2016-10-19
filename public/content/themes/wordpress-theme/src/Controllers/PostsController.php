<?php

namespace WordpressTheme\Controllers;

use WordpressTheme\Views\View;

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
        return (new View())->render('/posts/single');
    }
}
