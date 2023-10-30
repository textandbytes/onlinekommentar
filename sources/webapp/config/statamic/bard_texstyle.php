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
        //     'type'   => 'heading_1',
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
            'type' => 'span',
            'name' => 'Paragraph Number',
            'icon' => 'square',
            'ident' => '#',
            'class' => 'paragraph-nr',
            'cp_css' => 'background: #dee3e9; border-radius: 3px; padding: 1px 3px;',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Attributes (pro only)
    |--------------------------------------------------------------------------
    |
    | The attributes that can be edited through the attributes panel.
    |
    */

    'attributes' => [

        // 'heading_1' => [
        //     'id' => [
        //         'type' => 'text',
        //         'display' => 'ID',
        //         'default' => null,
        //         'rendered' => true,
        //     ],
        //     'hero' => [
        //         'type' => 'toggle',
        //         'display' => 'Hero',
        //         'default' => null,
        //         'rendered' => 'class',
        //         'values' => [
        //             'true' => 'hero',
        //         ],
        //     ],
        // ],

        // 'ordered_list' => [
        //     'start' => [
        //         'type' => 'text',
        //         'display' => 'Start',
        //         'default' => null,
        //         'rendered' => true,
        //     ],
        //     'reversed' => [
        //         'type' => 'toggle',
        //         'display' => 'Reversed',
        //         'default' => null,
        //         'rendered' => true,
        //     ],
        // ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Default Classes
    |--------------------------------------------------------------------------
    |
    | Default classes that will be applied to elements with no style set.
    |
    */

    'defaults' => [

        // 'heading_1' => [
        //     'class' => 'heading-1',
        //     'cp_css' => null,
        //     'cp_badge' => false,
        // ],
        // 'heading_2' => [
        //     'class' => 'heading-2',
        //     'cp_css' => null,
        //     'cp_badge' => false,
        // ],
        // 'paragraph' => [
        //     'class' => 'paragraph',
        //     'cp_css' => null,
        //     'cp_badge' => false,
        // ],

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
