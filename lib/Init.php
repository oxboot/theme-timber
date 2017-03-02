<?php

namespace Oxboot;

use Oxboot\Template;

class Init
{
    public function __construct()
    {
        /**
         * Theme setup
         */
        add_action('after_setup_theme', function () {
            /**
             * Make theme available for translation
             */
            load_theme_textdomain('oxboot', get_template_directory() . '/lang');

            /**
             * Enable plugins to manage the document title
             * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
             */
            add_theme_support('title-tag');

            /**
             * Register navigation menus
             * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
             */
            register_nav_menus([
                'primary' => __('Primary Menu', 'oxboot'),
                'secondary' => __('Secondary Menu', 'oxboot'),
                'sidebar' => __('Sidebar Menu', 'oxboot'),
                'additional' => __('Additional Menu', 'oxboot'),
                'footer' => __('Footer Menu', 'oxboot')
            ]);

            /**
             * Enable post thumbnails
             * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
             */
            add_theme_support('post-thumbnails');

            /**
             * Enable post formats
             * @link http://codex.wordpress.org/Post_Formats
             */
            add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

            /**
             * Enable HTML5 markup support
             * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
             */
            add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

            /**
             * Enable selective refresh for widgets in customizer
             * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
             */
            add_theme_support('customize-selective-refresh-widgets');

            /**
             * Use main stylesheet for visual editor
             * @see assets/styles/layouts/_tinymce.scss
             */
            add_editor_style(get_template_directory_uri() . '/public/css/main.css');
        }, 20);

        /**
         * Register sidebars
         */
        add_action('widgets_init', function () {
            $config = [
                'before_widget' => '<section class="widget %1$s %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3>',
                'after_title'   => '</h3>'
            ];
            register_sidebar([
                    'name'          => __('Primary Sidebar', 'oxboot'),
                    'id'            => 'sidebar-primary'
                ] + $config);
            register_sidebar([
                    'name'          => __('Secondary Sidebar', 'oxboot'),
                    'id'            => 'sidebar-secondary'
                ] + $config);
            register_sidebar([
                    'name'          => __('Footer', 'oxboot'),
                    'id'            => 'sidebar-footer'
                ] + $config);
        });

        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_style('oxboot/admin-custom.css', get_template_directory_uri().'/public/css/admin.css');
        });

        add_filter('template_include', function ($template) {
            $template = str_replace(
                [THEME, BASE . 'wp-content' . DS, '.php'],
                ['', '', '.twig'],
                str_replace(DIRECTORY_SEPARATOR, DS, $template)
            );
            new Template($template == 'index.twig' ? null : $template);
            return get_theme_file_path('index.php');
        });
    }
}
