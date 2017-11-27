<?php

namespace WordpressTheme\Hooks\Admin\Pages\PageWithTabs\Tabs;

use WordpressTheme\Hooks\Admin\AbstractTab;

class TabOne extends AbstractTab
{
    /**
     * @var string
     */
    protected $title = 'Tab 1';

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
