<?php

namespace WordpressTheme\Hooks\Admin\Pages;

use WordpressTheme\Hooks\Admin\AbstractPage;

class PageWithoutTabs extends AbstractPage
{
    /**
     * The page's title. Required.
     *
     * @var string
     */
    protected $title = 'Without tabs';

    /**
     * The dash icon css class. Optional.
     *
     * @var string
     */
    protected $dashicon = 'dashicons-format-image';

    /**
     * The position of the main item. Optional.
     *
     * @var int|null
     */
    protected $position = 80;

    /**
     * Handles the POST data.
     *
     * No need to verify nonce:
     *
     * @see AbstractPage::_handle()
     */
    public function handle()
    {
        // code
    }
}
