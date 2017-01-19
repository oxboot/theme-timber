<?php

namespace Oxboot;

use Timber\Timber;
use Timber\Menu;

class Template
{
    public function __construct($custom_template)
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
        $context['posts'] = $template_engine::get_posts();
        $context['pagination'] = $template_engine::get_pagination();
        foreach (get_nav_menu_locations() as $menu_location => $menu_id) {
            $context['menu_' . $menu_location ] = new Menu($menu_id);
        }
        if (is_404()) :
            $templates[] = '404.twig';
        elseif ($custom_template) :
            $templates[] = $custom_template;
        elseif (is_search()) :
            $templates[] = 'search.twig';
        elseif (is_front_page()) :
            $templates[] = 'front-page.twig';
        elseif (is_post_type_archive()) :
            $templates[] = $post_type . '.archive.twig';
        elseif (is_singular()) :
            $templates[] = $post_type . '.single.twig';
        elseif (is_author()) :
            $templates[] = 'author.twig';
        elseif (is_archive()) :
            $templates[] = 'archive.twig';
        endif;
        $templates[] = 'index.twig';
        $template_engine::render($templates, $context);
    }
}
