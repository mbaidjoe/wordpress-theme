<?php

/**
 * File with simple but helpful functions. Always check for existing functions before adding other functions!
 */

if (function_exists('path') === false) {
    /**
     * Returns the full path to a directory.
     *
     * @param  string $directory
     * @return string
     */
    function path($directory)
    {
        return get_stylesheet_directory() . $directory;
    }
}

if (function_exists('asset') === false) {
    /**
     * Loads the unminified url or file if the manifest file does not exist or WP_DEBUG is true. Returns the 'hashed'
     * version if it exists.
     *
     * @param  string  $file
     * @param  boolean $asUrl
     * @return string
     */
    function asset($file, $asUrl = true)
    {
        $path     = pathinfo($file, PATHINFO_DIRNAME);
        $basename = pathinfo($file, PATHINFO_BASENAME);
        $manifest = path($path . '/rev-manifest.json');
        $basePath = $asUrl ? get_stylesheet_directory_uri() : get_stylesheet_directory();

        if (file_exists($manifest) === false || WP_DEBUG) {
            return $basePath . $file;
        }

        $json     = file_get_contents($manifest);
        $manifest = json_decode($json, true);

        return $basePath . $path . '/' . array_get($manifest, $basename, $basename);
    }
}

if (function_exists('hook') === false) {
    /**
     * Creates a new instance of the hook class and class the apply method.
     *
     * @param string $class
     */
    function hook($class)
    {
        (new $class)->apply();
    }
}

if (function_exists('job') === false) {
    /**
     * Adds a (cron) job.
     *
     * @param string $class
     */
    function job($class)
    {
        /** @var \WordpressTheme\Jobs\AbstractJob $job */
        $job = new $class();

        add_action('after_switch_theme', function () use ($job) {
            $job->activate();
        });

        add_action('switch_theme', function () use ($job) {
            $job->deactivate();
        });

        add_action($job->getSlug(), [$job, 'run']);

        $job->addInterval();
    }
}
