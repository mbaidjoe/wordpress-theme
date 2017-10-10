# WordPress base theme

This base theme can be used as a starting point to create your own theme. Thanks to Composer everything is loaded in the
most easy way. But it is no ony a theme. It also uses Composer to load the WordPress files. See below for more detailed
information.

## Requirements

Most servers running PHP should be able serving this 'custom' WordPress installation. At least necessary:

* MySQL
* Apache / Nginx
* PHP 7+

## Installation

Run the following commands:
* `composer create-project rolfdenhartog/wordpress-theme path/of/installation`
* `cd public/content/themes/wordpress-theme`
* `yarn install` or `npm install`
* `gulp build:develop`

## Configuration

Copy and rename the file `/wp-config-sample.php` to `/wp-config.php`. Change the settings to your needs. Use different
settings for each environment of you follow Git Flow!

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

### Directory structure

```
- public (or public_html, wwwroot, etc.)
  - content
    - plugins
    - themes
      - wordpress-theme
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

**Rename**

If you have a different directory name than `public`, you'll only have to change the `composer.json` file. And if you
want to rename the theme and the namespace, you'll have to search and replace 'wordpress-theme' and 'WordPressTheme'.
There is a line in the `composer.json` file which contains `"type:wordpress-theme"`. This should not be changed! Don't
forget to rename the theme directory as well :wink:

