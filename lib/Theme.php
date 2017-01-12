<?php

namespace Oxboot;

use Timber\Menu;
use Timber\Timber;

class Theme
{
    public function __construct()
    {
        if (is_admin()) {
            return false;
        }

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
        $context['posts'] = $template_engine::get_posts();
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
        if (is_404()) {
            $templates = ['errors/404.twig'];
        }
        $template_engine::render($templates, $context);
        return true;
    }
}
