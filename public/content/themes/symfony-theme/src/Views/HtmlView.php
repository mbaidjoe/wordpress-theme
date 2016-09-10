<?php

namespace SymfonyTheme\Views;

/**
 * HtmlView class.
 */
class HtmlView extends AbstractView
{
    /**
     * Array with stylesheets to load.
     *
     * @var array
     */
    protected $styles = [];

    /**
     * Array with scripts to load.
     *
     * @var array
     */
    protected $scripts = [];

    /**
     * @param string $file
     */
    public function loadAsset($file)
    {
        if (pathinfo($file, PATHINFO_EXTENSION) === 'css') {
            $this->styles[str_slug($file)] = $file;
        } else {
            $this->scripts[str_slug($file)] = $file;
        }
    }

    /**
     * Renders a full page.
     *
     * @param  string $template
     * @param  array  $data
     * @return string
     */
    public function renderPage($template, array $data = [])
    {
        add_action('wp_enqueue_scripts', function () {
            // styles
            foreach ($this->styles as $handle => $script) {
                wp_enqueue_style($handle, asset($script));
            }

            // scripts
            foreach ($this->scripts as $handle => $script) {
                wp_enqueue_script($handle, asset($script), ['jquery']);
            }
        });

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
