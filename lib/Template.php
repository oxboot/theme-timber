<?php

namespace Oxboot;

use Timber\Timber;
use Timber\Menu;

class Template
{
    public function __construct($custom_template = null)
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
        $post_type = get_post_type();
        $context['posts'] = $template_engine::get_posts($post_type);
        var_dump($post_type);
        $context['pagination'] = $template_engine::get_pagination();
        foreach (get_nav_menu_locations() as $menu_location => $menu_id) {
            $context['menu_' . $menu_location ] = new Menu($menu_id);
        }
        $templates = ['index.twig'];
        if (is_post_type_archive($post_type)) {
            $templates = [$post_type . '.archive.twig'];
        }
        if (is_singular($post_type)) {
            $templates = [$post_type . '.single.twig'];
        }
        if (is_search()) {
            $templates = ['search.twig'];
        }
        if ($custom_template) {
            if (file_exists(BASE . 'views/custom/' . $custom_template . '.twig')) {
                $templates = ['custom/' . $custom_template . '.twig'];
            }
        }
        if (is_404()) {
            $templates = ['errors/404.twig'];
        }
        $template_engine::render($templates, $context);
    }
}
