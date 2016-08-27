<?php

/**
 * Include environment specific settings.
 */
require_once __DIR__ . '/../wp-config.php';

/**
 * Include composer auto loader.
 */
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Root directory of project.
 */
define('APP_ROOT', realpath(__DIR__ . '/..'));

/**
 * Url's.
 */
define('WP_HOME',    APP_DOMAIN);
define('WP_SITEURL', APP_DOMAIN . '/wp');

/**
 * Directory and url to the content directory.
 */
define('WP_CONTENT_DIR', __DIR__ . '/content');
define('WP_CONTENT_URL', APP_DOMAIN . '/content');

/**
 * Disable WordPress cron.
 *
 * You should not change this setting. The WordPress cron is run on a http request and makes the request run much
 * slower. If you are not able to add cron jobs, you can disable this setting.
 */
define('DISABLE_WP_CRON', true);

/**
 * Disables the update and file edit in the WordPress admin.
 *
 * You should never trust the visitors of your site. So always validate their input on forms. But you should not always
 * trust the users of your site too. They can install bad coded plugins for example. Or update the site before it has
 * been tested. Therefor these settings gives the developer more control.
 */
define('DISALLOW_FILE_MODS', true);
define('AUTOMATIC_UPDATER_DISABLED', true);
define('WP_AUTO_UPDATE_CORE', false);

/**
 * Increase memory limit for better performance.
 */
define('WP_MEMORY_LIMIT', '256M');

/**
 * Other database settings.
 */

define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

$table_prefix = 'wp_';

/**
 * Absolute path to the WordPress directory.
 */
if (!defined('ABSPATH'))
    define('ABSPATH', __DIR__ . '/');

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
