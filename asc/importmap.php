<?php

/**
 * Returns the importmap for this application.
 *
 * - "path" is a path inside the asset mapper system. Use the
 *     "debug:asset-map" command to see the full list of paths.
 *
 * - "entrypoint" (JavaScript only) set to true for any module that will
 *     be used as an "entrypoint" (and passed to the importmap() Twig function).
 *
 * The "importmap:require" command can be used to add new entries to this file.
 */
return [
    'app' => [
        'path' => './assets/app.js',
        'entrypoint' => true,
    ],
    '@symfony/stimulus-bundle' => [
        'path' => './vendor/symfony/stimulus-bundle/assets/dist/loader.js',
    ],
    '@symfony/ux-live-component' => [
        'path' => './vendor/symfony/ux-live-component/assets/dist/live_controller.js',
    ],
    '@hotwired/stimulus' => [
        'version' => '3.2.2',
    ],
    '@hotwired/turbo' => [
        'version' => '8.0.13',
    ],
    'bootstrap' => [
        'version' => '5.3.3',
    ],
    'jquery' => [
        'version' => '3.7.1',
    ],
    'popper.js' => [
        'version' => '1.16.1',
    ],
    'bootstrap/dist/css/bootstrap.min.css' => [
        'version' => '5.3.3',
        'type' => 'css',
    ],
    'node-waves' => [
        'version' => '0.7.6',
    ],
    'feather-icons' => [
        'version' => '4.29.2',
    ],
    '@swup/fade-theme' => [
        'version' => '2.0.1',
    ],
    '@swup/slide-theme' => [
        'version' => '2.0.1',
    ],
    '@swup/forms-plugin' => [
        'version' => '3.6.0',
    ],
    '@swup/plugin' => [
        'version' => '4.0.0',
    ],
    'swup' => [
        'version' => '4.8.1',
    ],
    'delegate-it' => [
        'version' => '6.2.1',
    ],
    '@swup/debug-plugin' => [
        'version' => '4.1.0',
    ],
    'jquery.counterup' => [
        'version' => '2.1.0',
    ],
    'footable' => [
        'version' => '2.0.6',
    ],
    'jsgrid' => [
        'version' => '1.5.3',
    ],
    'nestable2' => [
        'version' => '1.6.0',
    ],
    '@popperjs/core' => [
        'version' => '2.11.8',
    ],
    '@swup/theme' => [
        'version' => '2.1.0',
    ],
    'path-to-regexp' => [
        'version' => '6.3.0',
    ],
];
