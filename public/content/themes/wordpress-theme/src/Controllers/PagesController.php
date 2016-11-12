<?php

namespace WordpressTheme\Controllers;

use WordpressTheme\View;

class PagesController
{
    /**
     * Renders a single page.
     *
     * @param  string $slug
     * @return string
     */
    public function render($slug)
    {
        $view         = new View();
        $template     = '/page';
        $pageTemplate = get_post_meta(get_the_ID(), '_wp_page_template', true);

        if ($pageTemplate && $pageTemplate !== 'default') {
            $template = '/templates/' . $pageTemplate;
        }

        return $view->render($template);
    }
}
