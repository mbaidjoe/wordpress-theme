<?php

namespace WordpressTheme;

use League\Plates\Engine;

/**
 * View class.
 */
class View
{
    /**
     * @var Engine|null
     */
    private $engine = null;

    /**
     * View constructor.
     */
    public function __construct()
    {
        $this->engine = new Engine(path('/resources/views'));
    }


    /**
     * Renders a template.
     *
     * @param  string $template
     * @param  array  $data
     * @return string
     */
    public function render($template, array $data = [])
    {
        return $this->engine->render($template, $data);
    }
}
