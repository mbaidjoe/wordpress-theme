<?php

/**
 * This file returns a collection of routes. Visit the symfony website for documentation about symfony routing.
 *
 * @link http://symfony.com/doc/current/components/routing.html
 * @link http://symfony.com/doc/current/components/routing.html#defining-routes
 */

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

$routeCollection = new RouteCollection();

/**
 * Homepage.
 */
$routeCollection->add('homepage', new Route('/', [
    'controller' => \SymfonyTheme\Controllers\HomepageController::class,
]));

/**
 * Posts.
 */
$routeCollection->add('post_single', new Route('/{year}/{month}/{slug}/', [
    'controller' => \SymfonyTheme\Controllers\PostsController::class,
    'arguments'  => [
        'year',
        'month',
        'slug',
    ], [
        'year'  => '[0-9]{4}',
        'month' => '[0-9]{2}',
        'slug'  => '[a-z0-9-]+',
    ]
]));

/**
 * Custom post type.
 */
$routeCollection->add('product_archive', new Route('/products/', [
    'controller' => \SymfonyTheme\Controllers\ProductsController::class,
    'method'     => 'archive',
    'arguments'  => ['slug'],
]));
$routeCollection->add('product_single', new Route('/product/{slug}/', [
    'controller' => \SymfonyTheme\Controllers\ProductsController::class,
    'method'     => 'single',
    'arguments'  => ['slug'],
]));

/**
 * Pages. This route needs to be the last one!
 */
$routeCollection->add('page_single', new Route('/{slug}/', [
    'controller' => \SymfonyTheme\Controllers\PagesController::class,
    'arguments'  => ['slug'],
], [
    'slug' => '[a-z0-9-/]+',
]));

return $routeCollection;
