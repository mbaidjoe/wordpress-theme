<?php

namespace SymfonyTheme\Hooks\Theme;

use SymfonyTheme\Hooks\HookInterface;

/**
 * CleanUp class.
 */
class CleanUp implements HookInterface
{
    /**
     * Calls the methods to apply hooks.
     */
    public function apply()
    {
        $this->removeMetaVersion();
        $this->disableWpEmojicons();
        $this->removeXmlRpc();
        $this->removeWlw();
        $this->removeJson();
        $this->removeEmbedScript();
    }

    /**
     * Removes the version.
     */
    private function removeMetaVersion()
    {
        add_filter('the_generator', '__return_false');
        add_filter('script_loader_src', [$this, 'removeVersionFromUrl']);
        add_filter('style_loader_src', [$this, 'removeVersionFromUrl']);
    }

    /**
     * Removes the version from the asset urls.
     *
     * @param  string $src
     * @return string
     */
    public function removeVersionFromUrl($src)
    {
        global $wp_version;

        parse_str(parse_url($src, PHP_URL_QUERY), $query);

        if (!empty($query['ver']) && $query['ver'] === $wp_version) {
            $src = remove_query_arg('ver', $src);
        }

        return $src;
    }

    /**
     * Disable emoji.
     */
    private function disableWpEmojicons()
    {
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('admin_print_styles',  'print_emoji_styles');
        remove_action('wp_head',             'print_emoji_detection_script', 7);
        remove_action('wp_print_styles',     'print_emoji_styles');
        remove_filter('comment_text_rss',    'wp_staticize_emoji');
        remove_filter('the_content_feed',    'wp_staticize_emoji');
        remove_filter('wp_mail',             'wp_staticize_emoji_for_email');

        add_filter('tiny_mce_plugins', function ($plugins) {
            if (is_array($plugins)) {
                return array_diff($plugins, ['wpemoji']);
            } else {
                return [];
            }
        });
    }

    /**
     * Removes the xmlrpc link.
     */
    private function removeXmlRpc()
    {
        remove_action('wp_head', 'rsd_link');
    }

    /**
     * Removes the wlw link.
     */
    private function removeWlw()
    {
        remove_action('wp_head', 'wlwmanifest_link');
    }

    /**
     * Removes the json link from the head and headers.
     */
    private function removeJson()
    {
        add_filter('rest_enabled', '__return_false');
        add_filter('rest_jsonp_enabled', '__return_false');
        remove_action('wp_head', 'rest_output_link_wp_head', 10);
        remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
        remove_action('template_redirect', 'rest_output_link_header', 11);
    }

    /**
     * Removes the embed script.
     */
    private function removeEmbedScript()
    {
        add_action('wp_enqueue_scripts', function () {
            wp_deregister_script('wp-embed');
        });
    }
}
