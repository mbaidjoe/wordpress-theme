<?php

namespace SymfonyTheme\Hooks\Theme;

use SymfonyTheme\Hooks\HookInterface;

/**
 * PostTypeProduct class.
 */
class RegisterPostTypeProduct implements HookInterface
{
    /**
     * Calls the methods to apply hooks.
     */
    public function apply()
    {
        $this->register();
    }

    /**
     * Registers the post type.
     */
    private function register()
    {
        add_action('init', function () {
            register_post_type('product', [
                'label'               => __('Product', 'symfony-theme'),
                'description'         => __('Products', 'symfony-theme'),
                'labels'              => [
                    'name'                  => _x('Products', 'Post Type General Name', 'symfony-theme'),
                    'singular_name'         => _x('Product', 'Post Type Singular Name', 'symfony-theme'),
                    'menu_name'             => __('Products', 'symfony-theme'),
                    'name_admin_bar'        => __('Product', 'symfony-theme'),
                    'archives'              => __('Item Archives', 'symfony-theme'),
                    'parent_item_colon'     => __('Parent Item:', 'symfony-theme'),
                    'all_items'             => __('All Items', 'symfony-theme'),
                    'add_new_item'          => __('Add New Item', 'symfony-theme'),
                    'add_new'               => __('Add New', 'symfony-theme'),
                    'new_item'              => __('New Item', 'symfony-theme'),
                    'edit_item'             => __('Edit Item', 'symfony-theme'),
                    'update_item'           => __('Update Item', 'symfony-theme'),
                    'view_item'             => __('View Item', 'symfony-theme'),
                    'search_items'          => __('Search Item', 'symfony-theme'),
                    'not_found'             => __('Not found', 'symfony-theme'),
                    'not_found_in_trash'    => __('Not found in Trash', 'symfony-theme'),
                    'featured_image'        => __('Featured Image', 'symfony-theme'),
                    'set_featured_image'    => __('Set featured image', 'symfony-theme'),
                    'remove_featured_image' => __('Remove featured image', 'symfony-theme'),
                    'use_featured_image'    => __('Use as featured image', 'symfony-theme'),
                    'insert_into_item'      => __('Insert into item', 'symfony-theme'),
                    'uploaded_to_this_item' => __('Uploaded to this item', 'symfony-theme'),
                    'items_list'            => __('Items list', 'symfony-theme'),
                    'items_list_navigation' => __('Items list navigation', 'symfony-theme'),
                    'filter_items_list'     => __('Filter items list', 'symfony-theme'),
                ],
                'supports'            => ['title', 'editor', 'thumbnail', 'revisions'],
                'hierarchical'        => false,
                'public'              => true,
                'show_ui'             => true,
                'show_in_menu'        => true,
                'menu_position'       => 22,
                'show_in_admin_bar'   => true,
                'show_in_nav_menus'   => true,
                'can_export'          => true,
                'has_archive'         => 'products',
                'exclude_from_search' => false,
                'publicly_queryable'  => true,
                'rewrite'             => [
                    'slug'       => 'product',
                    'with_front' => true,
                    'pages'      => true,
                    'feeds'      => false,
                ],
                'capability_type'     => 'post',
            ]);
        });
    }
}
