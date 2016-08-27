<?php

/**
 * Use this file to add hooks. Hooks are added by the `hook` function (see helpers.php). Hook classes are placed in the
 * src/Hooks/{Theme/Plugin/Whatever}/HookClass directory. Hooks should always implement `HookInterface`.
 */

/**
 * Theme hooks.
 */
hook(\SymfonyTheme\Hooks\Theme\CleanUp::class);
hook(\SymfonyTheme\Hooks\Theme\RegisterPostTypeProduct::class);
hook(\SymfonyTheme\Hooks\Theme\Navigation::class);
hook(\SymfonyTheme\Hooks\Theme\PageTemplates::class);

/**
 * Admin hooks.
 */
hook(\SymfonyTheme\Controllers\Admin\Settings::class);
hook(\SymfonyTheme\Controllers\Admin\GeneralSettings::class);

/**
 * Plugin hooks.
 */
hook(\SymfonyTheme\Hooks\Plugins\WordPressSeo::class);

/**
 * Cron jobs.
 */
//job(\SymfonyTheme\Jobs\YourJob::class);
