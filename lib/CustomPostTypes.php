<?php

namespace Oxboot;

use CustomPostTypes\PostType;

class CustomPostTypes
{
    public function __construct()
    {
        $books = new PostType([
            'name' => 'book',
            'singular' => 'Book',
            'plural' => 'Books',
            'slug' => 'books'
        ]);
    }
}
