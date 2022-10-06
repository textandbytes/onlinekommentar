<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Styles
    |--------------------------------------------------------------------------
    |
    | List of toggleable styles.
    |
    */

    'styles' => [

        // 'hero' => [
        //     'type'   => 'heading',
        //     'level'  => 1,
        //     'name'   => 'Hero Heading',
        //     'ident'  => 'H',
        //     'class'  => 'hero-heading',
        //     'cp_css' => 'font-family: Caslon',
        // ],

        // 'intro' => [
        //     'type'   => 'paragraph',
        //     'name'   => 'Introduction',
        //     'ident'  => 'I',
        //     'class'  => 'introduction',
        //     'cp_css' => 'font-size: 1.25em; margin-top: -0.5em',
        // ],

        'paragraph_nr' => [
            'type'   => 'span',
            'name'   => 'Paragraph Nr',
            'ident'  => 'Nr',
            'class'  => 'paragraph-nr',
            'cp_css' => 'position:absolute margin-left:-20px font-size: 0.75rem font-family: "Work Sans"',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Default Classes
    |--------------------------------------------------------------------------
    |
    | Default classes that will be applied to elements with no style set.
    |
    */

    'default_classes' => [
        // 'heading' => [
        //     1 => 'heading-1',
        //     2 => 'heading-2',
        //     3 => 'heading-3',
        //     4 => 'heading-4',
        //     5 => 'heading-5',
        //     6 => 'heading-6',
        // ],
        // 'paragraph' => 'paragraph',
    ],

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    |
    | By default the class names are saved to your content. If you would prefer
    | to save the style keys instead you can change this option to "key".
    |
    */

    'store' => 'class',

];
