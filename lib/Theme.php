<?php

namespace Oxboot;

use Timber\Timber;

class Theme
{
    public function __construct()
    {
        /**
         * Theme assets
         */
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_style('oxboot/main.css', get_template_directory_uri() . '/public/css/main.css', false, null);
            wp_enqueue_script('oxboot/main.js', get_template_directory_uri() . '/public/js/main.js', ['jquery'], null, true);
        }, 100);

        /**
         * Timber compilation
         */
        $template_engine = new Timber();
        $context = $template_engine::get_context();
        $context['posts'] = $template_engine::get_posts();
        $templates = ['index.twig'];
        $template_engine::render($templates, $context);
    }
}
