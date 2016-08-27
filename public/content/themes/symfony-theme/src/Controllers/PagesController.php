<?php

namespace SymfonyTheme\Controllers;

use SymfonyTheme\Views\HtmlView;

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
        $view         = new HtmlView();
        $template     = '/page';
        $pageTemplate = get_post_meta(get_the_ID(), '_wp_page_template', true);

        if ($pageTemplate && $pageTemplate !== 'default') {
            $template = '/templates/' . $pageTemplate;
        }

        return $view->renderPage($template);
    }
}
