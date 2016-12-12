<?php

/**
 * Pages in this theme are loaded differently from other WordPress themes. The theme is using Symfony components. This
 * way we can use controllers in the theme. Therefor you need to define the routes (in routes.php).
 *
 * The structure of this theme:
 *
 * - resources
 *   - assets
 *     - styles
 *       - ...
 *     - scripts
 *       - ...
 *     - images
 *       - ...
 *     - vendor (bower, should be git ignored)
 *       - ...
 *   - views
 *     - ...
 * - src
 *   - Controllers
 *     - ...
 *   - Views
 *     - ...
 */

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;

/**
 * Get the routes and create the objects to find the matching url.
 */
$routes         = require __DIR__ . '/routes.php';
$requestContext = (new RequestContext())->fromRequest(Request::createFromGlobals());
$urlMatcher     = new UrlMatcher($routes, $requestContext);

/**
 * The default controller if anything goes wrong.
 */
$errorController = \WordpressTheme\Controllers\ErrorController::class;

/**
 * Get requested uri.
 */
$requestUri = filter_input(INPUT_SERVER, 'REQUEST_URI');

try {
    $route         = $urlMatcher->match($requestUri);
    $controller    = array_get($route, 'controller');
    $method        = array_get($route, 'method', 'render');
    $argument_vars = array_get($route, 'arguments', []);

    /**
     * Check the WordPress function for non existing pages.
     */
    if (is_404()) {
        $controller = $errorController;
        $method     = 'render404';
    }

    /**
     * If the class does not exists, we need an error page.
     */
    elseif (class_exists($controller) === false) {
        $controller = $errorController;
        $method     = 'render400';
    }
} catch (\Exception $e) {
    $route         = [];
    $controller    = $errorController;
    $method        = 'render404';
    $argument_vars = [];
}

$arguments = collect($argument_vars)->map(function ($value) use ($route) {
    return array_get($route, $value);
})->toArray();

echo call_user_func_array([new $controller(), $method], $arguments);
