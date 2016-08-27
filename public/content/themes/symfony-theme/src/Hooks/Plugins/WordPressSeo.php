<?php

namespace SymfonyTheme\Hooks\Plugins;

use SymfonyTheme\Hooks\HookInterface;

/**
 * WordPressSeo class.
 */
class WordPressSeo implements HookInterface
{
    /**
     * Calls the methods to apply hooks.
     */
    public function apply()
    {
        $this->removeVersionNumber();
    }

    /**
     * Removes the version number of the plugin from the html head.
     */
    private function removeVersionNumber()
    {
        if (class_exists('WPSEO_Frontend')) {
            remove_action('wpseo_head', [\WPSEO_Frontend::get_instance(), 'debug_marker'], 2);
        }
    }
}
