<?php

namespace SymfonyTheme\Controllers;

use SymfonyTheme\Views\HtmlView;

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
        return (new HtmlView())->renderPage('/posts/single');
    }
}
