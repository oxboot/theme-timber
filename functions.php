<?php

namespace Oxboot;

/**
 * [en] Load config
 * [ru] Подключаем конфиг
 */
require('config.php');

/**
 * [en] PHP version check
 * [ru] Проверяем версию PHP
 */
if (version_compare('5.6.4', phpversion(), '>=')) {
    wp_die(
        'You must be using PHP 5.6.4 or greater.',
        'Invalid PHP version'
    );
}

/**
 * [en] Composer auto-loader check
 * [ru] Проверяем наличие загрузчика Composer
 */
if (!file_exists($composer = __DIR__.'/vendor/autoload.php')) {
    wp_die(
        'You must run <code>composer install</code> from the Oxboot theme directory.',
        'Autoloader not found.'
    );
}

/**
 * [en] Register the auto-loader
 * [ru] Подключаем зависимости Composer
 */
require_once $composer;

new Init();
new CustomPostTypes();

add_filter('template_include', function ($template) {
    $template = str_replace(
        [THEME, BASE . 'wp-content' . DS, '.php'],
        ['', '', '.twig'],
        str_replace(DIRECTORY_SEPARATOR, DS, $template)
    );
    new Template($template == 'index.twig' ? null : $template);
    return get_theme_file_path('index.php');
});
