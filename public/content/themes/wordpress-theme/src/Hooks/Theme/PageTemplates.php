<?php

namespace WordpressTheme\Hooks\Theme;

use WordpressTheme\Hooks\HookInterface;

/**
 * PageTemplates class.
 */
class PageTemplates implements HookInterface
{
    /**
     * Calls the methods to apply hooks.
     */
    public function apply()
    {
        $this->filter();
    }

    private function filter()
    {
        add_filter('theme_page_templates', function (array $pageTemplates, \WP_Theme $wpTheme, \WP_Post $post = null) {
            $templates = glob(path('/resources/views/templates') . '/*.php');

            foreach ($templates as $template) {
                $contents = file_get_contents($template);

                if ((bool) preg_match('|Template Name:(.*)$|mi', $contents, $matches)) {
                    $pageTemplates[pathinfo($template, PATHINFO_FILENAME)] = $matches[1];
                }
            }

            return $pageTemplates;
        }, 10, 3);
    }
}
