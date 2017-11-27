<?php

namespace WordpressTheme\Hooks\Admin\Pages;

use WordpressTheme\Hooks\Admin\AbstractPage;

class SubPage extends AbstractPage
{
    /**
     * The page's title. Can be set with __construct(). Required.
     *
     * @var string
     */
    protected $title = 'Sub page';

    /**
     * The slug of the parent page. Indicates a sub page. Optional.
     *
     * @var string
     */
    protected $parent = 'without-tabs';

    /**
     * The admin capability of the user. Defaults to 'manage_options'.
     *
     * @var string
     */
    protected $capability = 'manage_options';
}
