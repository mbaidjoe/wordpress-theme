<?php

namespace WordpressTheme\Controllers\Admin;

use WordpressTheme\Views\AdminView;

/**
 * AbstractPage class.
 */
class AbstractPage
{
    /**
     * The slug of the admin page.
     *
     * @var string
     */
    protected $slug = '';

    /**
     * The slug of the parent admin page. Optional.
     *
     * @var string
     */
    protected $parentSlug = '';

    /**
     * The title of the page.
     *
     * @var string
     */
    protected $title = '';

    /**
     * The necessary capability for the page.
     *
     * @var string
     */
    protected $capability = 'manage_options';

    /**
     * Array with notices.
     *
     * @var array
     */
    protected $notices = [];

    /**
     * - Checks if the interface is the WordPress admin.
     * - 'Registers' the page.
     * - Calls the method to check the nonce and calls the handle method for the post data.
     * - Calls the method to echo admin notices.
     */
    public function apply()
    {
        if (is_admin() === false) {
            return;
        }

        $this->addPage();
        $this->checkNonce();
        $this->echoAdminNotice();
    }

    /**
     * Adds the admin page.
     */
    protected function addPage()
    {
        add_action('admin_menu', function () {
            if ($this->parentSlug) {
                add_submenu_page(
                    $this->parentSlug,
                    $this->title,
                    $this->title,
                    $this->capability,
                    $this->slug,
                    [$this, 'render']
                );
            } else {
                add_menu_page(
                    $this->title,
                    $this->title,
                    $this->capability,
                    $this->slug
                );
            }
        });
    }

    /**
     * Handles the post data.
     */
    protected function checkNonce()
    {
        if (wp_verify_nonce(filter_input(INPUT_POST, 'wordpress-theme-nonce'), $this->slug)) {
            $this->handle();
        }
    }

    /**
     * Handles the post data.
     */
    protected function handle()
    {
    }

    /**
     * Echos the admin notice.
     */
    protected function echoAdminNotice()
    {
        $noticeSlug = filter_input(INPUT_GET, 'notice');
        $notice     = array_get($this->notices, $noticeSlug, false);

        if ($noticeSlug === null || $notice === false) {
            return;
        }

        add_action('admin_notices', function () use ($notice) {
            echo (new AdminView())->renderTemplate('/admin/notice', [
                'type'   => array_get($notice, 'type', 'notice'),
                'notice' => array_get($notice, 'notice'),
            ]);
        });
    }
}
