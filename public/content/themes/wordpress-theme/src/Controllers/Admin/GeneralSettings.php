<?php

namespace WordpressTheme\Controllers\Admin;

use WordpressTheme\View;

/**
 * GeneralSettings class.
 */
class GeneralSettings extends AbstractPage
{
    /**
     * The slug of the admin page.
     *
     * @var string
     */
    protected $slug = 'general-settings';

    /**
     * The slug of the parent admin page. Optional.
     *
     * @var string
     */
    protected $parentSlug = 'general-settings';

    /**
     * The title of the page.
     *
     * @var string
     */
    protected $title = 'General settings';

    /**
     * Array with notices.
     *
     * @var array
     */
    protected $notices = [
        'updated' => [
            'type'   => 'updated',
            'notice' => 'Settings updated',
        ],
    ];

    /**
     * Renders the page.
     */
    public function render()
    {
        echo view('/admin/general-settings');
    }

    /**
     * Handles the post data.
     */
    protected function handle()
    {
        update_option('wordpress-theme/general-settings/google-analytics-id', filter_input(INPUT_POST, 'google-analytics-id'));

        wp_redirect('?page=general-settings&notice=updated');
        die;
    }
}
