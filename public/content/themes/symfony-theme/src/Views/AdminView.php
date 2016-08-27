<?php

namespace SymfonyTheme\Views;

/**
 * AdminView class.
 */
class AdminView extends AbstractView
{
    /**
     * Array with stylesheets to load for the admin page.
     *
     * @var array
     */
    protected $styles = [];

    /**
     * Array with scripts to load for the admin page.
     *
     * @var array
     */
    protected $scripts = [];

    /**
     * @param string $filename
     */
    public function loadAsset($filename)
    {
        if (pathinfo($filename, PATHINFO_EXTENSION) === 'css') {
            $this->styles[str_slug($filename)] = $filename;
        } else {
            $this->scripts[str_slug($filename)] = $filename;
        }
    }

    /**
     * Renders the admin view.
     *
     * @param string $template
     * @param array  $data
     * @return string
     */
    public function renderPage($template, array $data = [])
    {
        add_action('admin_enqueue_scripts', function () {
            // styles
            foreach ($this->styles as $handle => $script) {
                wp_enqueue_style($handle, asset($script));
            }

            // scripts
            foreach ($this->scripts as $handle => $script) {
                wp_enqueue_script($handle, asset($script), ['jquery']);
            }
        });

        return $this->renderTemplate('/admin/_wrapper', [
            'content' => $this->renderTemplate($template, $data),
        ]);
    }
}
