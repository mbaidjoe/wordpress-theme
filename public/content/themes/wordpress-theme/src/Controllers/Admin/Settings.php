<?php

namespace WordpressTheme\Controllers\Admin;

/**
 * Settings class. This class creates the menu item in the admin.
 */
class Settings extends AbstractPage
{
    /**
     * The slug of the default admin sub page.
     *
     * @var string
     */
    protected $slug = 'general-settings';

    /**
     * The title and menu name. Doesn't need to be the name of the default sub page.
     *
     * @var string
     */
    protected $title = 'Theme settings';
}
