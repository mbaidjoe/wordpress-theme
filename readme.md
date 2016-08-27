# WordPress / Symfony theme

## Installation

Once you downloaded the repo, run the following commands:
* `composer install`
* `cd public/content/themes/symfony-theme`
* `npm install`
* `bower install`
* `gulp build`

## Configuration

Copy and rename the file `/wp-config-sample.php` to `/wp-config.php`. Change the settings to your needs. Use different
settings for each environment!

```php
<?php

/**
 * Domain of your site including the scheme.
 */
define('APP_DOMAIN', 'https://localhost');

/**
 * Database settings.
 */
define('DB_HOST', 'localhost');
define('DB_NAME', 'database_name_here');
define('DB_USER', 'username_here');
define('DB_PASSWORD', 'password_here');

/**
 * Authentication Unique Keys and Salts.
 *
 * @link https://api.wordpress.org/secret-key/1.1/salt/
 */
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

/**
 * For developers: WordPress debugging mode.
 */
define('WP_DEBUG', false);
```

### Directory structure:

```
- public (or public_html, wwwroot, etc.)
  - content
    - plugins
    - themes
      - symfony-theme
      - ...
    - uploads
  - wp (WordPress is installed in this directory)
    - wp-admin
    - wp-includes
    - ...
  - index.php
  - wp-config.php (settings for all environments without database credentials!)
- vendor
- .gitignore
- composer.json
- composer.lock
- wp-config.php (contains settings specifically for an environment, like database settings)
- wp-config-sample.php
```

### Theme directory structure

```
- symfony-theme
  - assets (git ignored, all the rendered and optimised files are in this directory)
    - ...
  - resources
    - assets
      - fonts
      - images
      - scripts
      - styles (directory with sass files)
      - vendor (the 'bower_components' directory)
  - views
     - templates
       - ...
     - layout.php
     - ...
  - src
    - Controllers
      - ...
    - ...
  - .bowerrc
  - .gitignore
  - bower.json
  - functions.php (contains all the hooks and cron jobs)
  - gulpfile.js
  - helpers.php (contains some small but helpful functions)
  - index.php ('bootstraps' the website)
  - package.json
  - routes.php (contains the url's and their controllers)
  - style.css (simply to register the theme in WordPress)
```
