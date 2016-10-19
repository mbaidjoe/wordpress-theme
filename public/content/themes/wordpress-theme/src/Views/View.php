<?php

namespace WordpressTheme\Views;

use League\Plates\Engine;

/**
 * View class.
 */
class View
{
    /**
     * Renders a template.
     *
     * @param  string $template
     * @param  array  $data
     * @return string
     */
    public function render($template, array $data = [])
    {
        return (new Engine(path('/resources/views')))->render($template, $data);
    }
}
