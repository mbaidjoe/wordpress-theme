<?php

namespace WordpressTheme\Hooks\Theme;

use WordpressTheme\Hooks\HookInterface;

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
                'label'               => __('Product', 'wordpress-theme'),
                'description'         => __('Products', 'wordpress-theme'),
                'labels'              => [
                    'name'                  => _x('Products', 'Post Type General Name', 'wordpress-theme'),
                    'singular_name'         => _x('Product', 'Post Type Singular Name', 'wordpress-theme'),
                    'menu_name'             => __('Products', 'wordpress-theme'),
                    'name_admin_bar'        => __('Product', 'wordpress-theme'),
                    'archives'              => __('Item Archives', 'wordpress-theme'),
                    'parent_item_colon'     => __('Parent Item:', 'wordpress-theme'),
                    'all_items'             => __('All Items', 'wordpress-theme'),
                    'add_new_item'          => __('Add New Item', 'wordpress-theme'),
                    'add_new'               => __('Add New', 'wordpress-theme'),
                    'new_item'              => __('New Item', 'wordpress-theme'),
                    'edit_item'             => __('Edit Item', 'wordpress-theme'),
                    'update_item'           => __('Update Item', 'wordpress-theme'),
                    'view_item'             => __('View Item', 'wordpress-theme'),
                    'search_items'          => __('Search Item', 'wordpress-theme'),
                    'not_found'             => __('Not found', 'wordpress-theme'),
                    'not_found_in_trash'    => __('Not found in Trash', 'wordpress-theme'),
                    'featured_image'        => __('Featured Image', 'wordpress-theme'),
                    'set_featured_image'    => __('Set featured image', 'wordpress-theme'),
                    'remove_featured_image' => __('Remove featured image', 'wordpress-theme'),
                    'use_featured_image'    => __('Use as featured image', 'wordpress-theme'),
                    'insert_into_item'      => __('Insert into item', 'wordpress-theme'),
                    'uploaded_to_this_item' => __('Uploaded to this item', 'wordpress-theme'),
                    'items_list'            => __('Items list', 'wordpress-theme'),
                    'items_list_navigation' => __('Items list navigation', 'wordpress-theme'),
                    'filter_items_list'     => __('Filter items list', 'wordpress-theme'),
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
