<?php

namespace SymfonyTheme\Views;

/**
 * HtmlView class.
 */
class HtmlView extends AbstractView
{
    /**
     * Renders a full page.
     *
     * @param  string $template
     * @param  array  $data
     * @return string
     */
    public function renderPage($template, array $data = [])
    {
        $html = $this->renderTemplate('/layout', array_merge($data, [
            'content' => $this->renderTemplate($template, $data),
        ]));

        return WP_DEBUG ? $html : preg_replace(
            ['/<!--(.*)-->/Uis', "/[[:blank:]]+/"],
            ['', ' ' ],
            str_replace(["\n", "\r", "\t"], '', $html)
        );
    }
}
