<?php

/**
 * @author Rolf den Hartog <rolf@rolfdenhartog.nl>
 */

namespace WordpressTheme\Hooks\Theme;
use WordpressTheme\Hooks\HookInterface;

/**
 * Support class.
 */
class Support implements HookInterface
{
    /**
     * Calls the methods to apply hooks.
     */
    public function apply()
    {
        $this->addTitleSupport();
        $this->addFeaturedImageSupport();
    }

    /**
     * Adds support for the title tag.
     */
    private function addTitleSupport()
    {
        add_action('after_setup_theme', function () {
            add_theme_support('title-tag');
        });
    }

    /**
     * Adds support for featured images.
     */
    private function addFeaturedImageSupport()
    {
        add_action('after_setup_theme', function () {
            add_theme_support('post-thumbnails');
        });
    }
}
