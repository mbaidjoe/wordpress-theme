<?php

namespace WordpressTheme\Controllers;

use WordpressTheme\Views\HtmlView;

class HomepageController
{
    /**
     * Renders the homepage.
     *
     * @return string
     */
    public function render()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_style('homepage', asset('/assets/styles/homepage.css'));
            wp_enqueue_script('homepage', asset('/assets/scripts/homepage.js'), [], false, true);
        });

        return (new HtmlView())->renderPage('/homepage');
    }
}
