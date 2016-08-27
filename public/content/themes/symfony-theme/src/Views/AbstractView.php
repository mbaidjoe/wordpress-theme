<?php

namespace SymfonyTheme\Views;

use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;

/**
 * AbstractView class.
 */
abstract class AbstractView
{
    /**
     * Renders a template.
     *
     * @param  string $template
     * @param  array  $data
     * @return string
     */
    public function renderTemplate($template, array $data = [])
    {
        $loader = new FilesystemLoader(get_stylesheet_directory() . '/resources/views%name%');
        $parser = new TemplateNameParser();
        $engine = new PhpEngine($parser, $loader);

        return $engine->render($template . '.php', $data);
    }
}
