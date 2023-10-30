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
            'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="currentColor" class="bts-icon-letter"><path d="M1.153,0.666C0.672,0.666 0.275,1.063 0.275,1.544L0.275,14.565C0.275,15.045 0.672,15.443 1.174,15.443C1.654,15.443 2.052,15.045 2.052,14.565L2.052,9.674C2.699,9.737 3.078,9.764 3.894,9.764C5.586,9.764 6.489,9.325 7.409,8.427C8.308,7.528 8.768,6.441 8.768,5.166C8.768,3.85 8.35,2.763 7.514,1.906C6.657,1.049 5.67,0.631 3.747,0.631C3.058,0.631 2.428,0.645 1.153,0.666ZM2.052,2.338C2.971,2.317 3.35,2.303 3.914,2.303C6.172,2.303 6.887,3.369 6.887,5.145C6.887,6.985 5.984,8.092 3.831,8.092C3.204,8.092 2.846,8.044 2.052,7.981L2.052,2.338Z" /><text text-anchor="middle" x="12.75" y="14.5" style="font-size: 10px; stroke-width: 1px; stroke: currentColor">N</text></svg>',
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
