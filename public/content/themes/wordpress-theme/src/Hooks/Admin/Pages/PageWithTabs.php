<?php

namespace WordpressTheme\Hooks\Admin\Pages;

use Illuminate\Support\Collection;
use WordpressTheme\Hooks\Admin\AbstractPage;
use WordpressTheme\Hooks\Admin\Pages\PageWithTabs\Tabs\TabOne;
use WordpressTheme\Hooks\Admin\Pages\PageWithTabs\Tabs\TabTwo;

class PageWithTabs extends AbstractPage
{
    /**
     * The page's title. Required.
     *
     * @var string
     */
    protected $title = 'With tabs';

    /**
     * The dash icon css class. Optional.
     *
     * @var string
     */
    protected $dashicon = 'dashicons-format-gallery';

    /**
     * The position of the main item. Optional.
     *
     * @var int|null
     */
    protected $position = 81;

    /**
     * @var Collection
     */
    protected $tabs = [
        TabOne::class,
        TabTwo::class,
    ];

    /**
     * Handles the POST data.
     *
     * No need to verify nonce:
     *
     * @see AbstractPage::_handle()
     */
    public function handle()
    {
        // this method can be left empty: tabs have there own handle method.
    }
}
