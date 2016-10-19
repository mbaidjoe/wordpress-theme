<?php

/**
 * Use this file to add hooks. Hooks are added by the `hook` function (see helpers.php). Hook classes are placed in the
 * src/Hooks/{Theme/Plugin/Whatever}/HookClass directory. Hooks should always implement `HookInterface`.
 */

/**
 * Theme hooks.
 */
hook(\WordpressTheme\Hooks\Theme\CleanUp::class);
hook(\WordpressTheme\Hooks\Theme\RegisterPostTypeProduct::class);
hook(\WordpressTheme\Hooks\Theme\Navigation::class);
hook(\WordpressTheme\Hooks\Theme\PageTemplates::class);

/**
 * Admin hooks.
 */
hook(\WordpressTheme\Controllers\Admin\Settings::class);
hook(\WordpressTheme\Controllers\Admin\GeneralSettings::class);

/**
 * Plugin hooks.
 */
hook(\WordpressTheme\Hooks\Plugins\WordPressSeo::class);

/**
 * Cron jobs.
 */
//job(\WordpressTheme\Jobs\YourJob::class);
