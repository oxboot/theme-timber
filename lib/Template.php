<?php

namespace Oxboot;

use Timber\Timber;
use Timber\Post;
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
        $post = new Post();
        $timber = new Timber();
        $context = $timber::get_context();
        $context['posts'] = $timber::get_posts();
        $context['pagination'] = $timber::get_pagination();
        foreach (get_nav_menu_locations() as $menu_location => $menu_id) {
            $context['menu_' . $menu_location ] = new Menu($menu_id);
        }
        if (is_404()) :
            $templates[] = '404.twig';
        elseif ($custom_template) :
            $templates[] = $custom_template;
        elseif (is_search()) :
            $templates[] = 'search.twig';
        elseif (is_author()) :
            $templates[] = 'author.twig';
        elseif (is_front_page()) :
            $templates[] = 'front-page.twig';
        endif;
        if (is_post_type_archive()) :
            $templates[] = $post->post_type . '.archive.twig';
        elseif (is_singular()) :
            $templates[] = $post->post_name . '.' . $post->post_type . '.single.twig';
            $templates[] = $post->post_type . '.single.twig';
        elseif (is_archive()) :
            $templates[] = 'archive.twig';
        endif;
        $templates[] = 'index.twig';
        $timber::render($templates, $context);
    }
}
