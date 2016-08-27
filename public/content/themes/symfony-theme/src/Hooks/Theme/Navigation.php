<?php

namespace SymfonyTheme\Hooks\Theme;

use SymfonyTheme\Hooks\HookInterface;

/**
 * Navigation class.
 */
class Navigation implements HookInterface
{
    /**
     * Calls the methods to apply hooks.
     */
    public function apply()
    {
        $this->registerMenus();
        $this->filterNavObjects();
        $this->filterNavItemClasses();
        $this->filterNavItemId();
    }

    /**
     * Registers the menus.
     */
    private function registerMenus()
    {
        add_action('after_setup_theme', function () {
            register_nav_menu('primary-menu', __('Primary menu', 'symfony-theme'));
        });
    }

    /**
     * Filters the items and adds the classes 'first' and 'last'.
     */
    private function filterNavObjects()
    {
        add_filter('wp_nav_menu_objects', function ($items) {
            $firstIndex = key($items);

            end($items);

            $lastIndex = key($items);

            $items[$firstIndex]->classes[] = 'first';
            $items[$lastIndex]->classes[]  = 'last';

            return $items;
        });
    }

    /**
     * Filters the classes for a navigation item.
     */
    private function filterNavItemClasses()
    {
        add_filter('nav_menu_css_class', function (array $classes, \WP_Post $item, $arguments, $depth) {
            return collect($classes)->filter(function ($class) {
                return in_array($class, [
                    'last',
                ]);
            })->toArray();
        }, 10, 4);
    }

    /**
     * Removes the id attribute from a nav item.
     */
    private function filterNavItemId()
    {
        add_filter('nav_menu_item_id', function () {
            return false;
        });
    }
}
