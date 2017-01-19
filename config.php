<?php

/**
 * [en] Determine the directory separator
 * [ru] Определяем разделитель директорий
 */
define('DS', '/');

/**
 * [en] Determine the base Wordpress directory
 * [ru] Определяем базовую папку Wordpress
 */
define('BASE', str_replace(DIRECTORY_SEPARATOR, DS, ABSPATH));

/**
 * [en] Determine the base theme directory
 * [ru] Определяем базовую папку темы
 */
define('THEME', str_replace(DIRECTORY_SEPARATOR, DS, __DIR__ . DS));

/**
 * [en] Determine the template engine
 * [ru] Определяем шаблонизатор
 */
define('TEMPLATE_ENGINE', 'Twig');

/**
 * [en] Switch Debugbar
 * [ru] Включаем Debugbar
 */
define('DEBUGBAR', true);
