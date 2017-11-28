<?php

/**
 * Use this file to add hooks. Hooks are added by the `hook` function (see helpers.php). Hook classes are placed in the
 * src/Hooks/{Theme/Plugin/Whatever}/HookClass directory. Hooks should always implement `HookInterface`.
 */

/**
 * Theme hooks.
 */
hook(\WordpressTheme\Hooks\Theme\CleanUp::class);
hook(\WordpressTheme\Hooks\Theme\Support::class);
hook(\WordpressTheme\Hooks\Theme\Navigation::class);

/**
 * Plugin hooks.
 */
hook(\WordpressTheme\Hooks\Plugins\WordPressSeo::class);

/**
 * Admin hooks.
 */
hook(\WordpressTheme\Hooks\Admin\Pages\PageWithoutTabs::class);
hook(\WordpressTheme\Hooks\Admin\Pages\SubPage::class);
hook(\WordpressTheme\Hooks\Admin\Pages\PageWithTabs::class);

/**
 * Cron jobs.
 */
//job(\WordpressTheme\Jobs\YourJob::class);
