<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Sites
    |--------------------------------------------------------------------------
    |
    | Each site should have root URL that is either relative or absolute. Sites
    | are typically used for localization (eg. English/French) but may also
    | be used for related content (eg. different franchise locations).
    |
    */

    'sites' => [

        'en' => [
            'name' => 'en',
            'locale' => 'en_US',
            'url' => '/en/',
        ],

        'de' => [
            'name' => 'de',
            'locale' => 'de_CH',
            'url' => '/de/',
        ],

        'fr' => [
            'name' => 'fr',
            'locale' => 'fr_CH',
            'url' => '/fr/',
        ],

        'it' => [
            'name' => 'it',
            'locale' => 'it_CH',
            'url' => '/it/',
        ],

    ],
];
