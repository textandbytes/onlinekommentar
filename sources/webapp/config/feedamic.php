<?php

use App\Scopes\FeedScope;

return [

    /*
    |--------------------------------------------------------------------------
    | Feeds
    |--------------------------------------------------------------------------
    |
    | Ability to define Atom and RSS feed routes.
    |
    | You can create as many feeds as you like in the key:value setup, and even
    | override some defaults (or use defaults) to make your config simpler.
    |
    | The key is used as a reference to your feed, and is used as part of the
    | cache key for the feed.
    |
    */

    'feeds' => [
        'en' => [
            'title' => 'Onlinekommentar',
            'description' => 'The Online Commentary (Onlinekommentar) is the first non-profit and Open Access commentary platform in Switzerland.',
            'routes' => [
                'atom' => '/en/feed/atom',
                'rss' => '/en/feed',
            ],
            'collections' => [
                'commentaries',
            ],
            'language' => 'en',
            'locales' => ['en'],
        ],
        'de' => [
            'title' => 'Onlinekommentar',
            'description' => 'Onlinekommentar.ch ist die erste gemeinnützige Plattform für Open-Access-Kommentare in der Schweiz.',
            'routes' => [
                'atom' => '/de/feed/atom',
                'rss' => '/de/feed',
            ],
            'collections' => [
                'commentaries',
            ],
            'language' => 'de',
            'locales' => ['de'],
        ],
        'fr' => [
            'title' => 'Onlinekommentar',
            'description' => 'Le Commentaire en ligne (Onlinekommentar) est la première plateforme de commentaires juridiques à but non lucratif et open access en Suisse.',
            'routes' => [
                'atom' => '/fr/feed/atom',
                'rss' => '/fr/feed',
            ],
            'collections' => [
                'commentaries',
            ],
            'language' => 'fr',
            'locales' => ['fr'],
        ],
        'it' => [
            'title' => 'Onlinekommentar',
            'description' => 'Il Commentario online (Onlinekommentar) è la prima piattaforma di commentari senza scopo di lucro e ad accesso aperto (Open Access) della Svizzera.',
            'routes' => [
                'atom' => '/it/feed/atom',
                'rss' => '/it/feed',
            ],
            'collections' => [
                'commentaries',
            ],
            'language' => 'it',
            'locales' => ['it'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key
    |--------------------------------------------------------------------------
    |
    | The base cache key for output.
    |
    | Will be cached forever until EventSaved is fired, or you manually clear the cache.
    |
    */

    'cache' => 'feedamic',

    /*
    |--------------------------------------------------------------------------
    | DEFAULTS: Summary
    |--------------------------------------------------------------------------
    |
    | This is the default that applies to all configured 'feeds', unless overwritten
    | for a specific feed configuration.
    |
    | A list of blueprint fields to look at to try to build the "summary" for the feed.
    |
    | This is ordered - the first field will be looked first, then the second, etc.
    |
    | When content is found, it will be used, and other fields will be ignored.
    |
    */

    'summary' => [
        'content',
    ],

    /*
    |--------------------------------------------------------------------------
    | DEFAULTS: Image
    |--------------------------------------------------------------------------
    |
    | This is the default that applies to all configured 'feeds', unless overwritten
    | for a specific feed configuration.
    |
    | Configuration options for the image to be injected in to the "summary" for the entry.
    |
    | This only applies when Summary is being used.
    |
    | The Fields behave like summary - a cascading list of image fields to look at. You can specify the width
    | and height too to use for the image generation. If omitted, will be 1280 x 720.
    |
    | Disable this by setting to false.
    |
    */

    'image' => [
        'fields' => [
            'hero',
            'meta_og_image',
        ],
        'width' => 1280,
        'height' => 720,
    ],

    /*
    |--------------------------------------------------------------------------
    | DEFAULTS: Author
    |--------------------------------------------------------------------------
    |
    | This is the default that applies to all configured 'feeds', unless overwritten
    | for a specific feed configuration.
    |
    | Sets the lookup of an author field.
    |
    | Set to "false" to disable looking for author details.
    |
    | If used,
    |   "handle" defines the blueprint reference to the author, a Statamic user
    |   "email", when true, will output the <email> for atom feeds
    |   "name", a pattern to use to build the name output
    |
    | For "name", each handle is in square brackets, and is used to concatenate fields if you are using
    | or want to customise the name output. For example, "[name_first] [name_last]" would pick "name_first"
    | and "name_last" from the User.
    |
    */

    'author' => [
        'handle' => 'author',

        // true to include the email in the feed, false to exclude - atom only
        'email' => false,

        // the name pattern to use for the author name
        'name' => '[name]',
    ],

    /*
    |--------------------------------------------------------------------------
    | DEFAULTS: Copyright
    |--------------------------------------------------------------------------
    |
    | This is the default that applies to all configured 'feeds', unless overwritten
    | for a specific feed configuration.
    |
    | A string to output to the <copyright> (RSS) or <rights> (Atom) feed.
    |
    | False will exclude this element.
    |
    */

    'copyright' => false,

    /*
    |--------------------------------------------------------------------------
    | DEFAULTS: Language
    |--------------------------------------------------------------------------
    |
    | This is the default that applies to all configured 'feeds', unless overwritten
    | for a specific feed configuration.
    |
    | Marks the feed as being in a specific language.
    |
    | As Atom, using xml:lang, can use more language definitions than the RSS specification, refer to the
    | RSS specification for suitable codes:
    |   https://www.rssboard.org/rss-language-codes
    |
    */

    'language' => 'en',

    /*
    |--------------------------------------------------------------------------
    | DEFAULTS: Limit
    |--------------------------------------------------------------------------
    |
    | This is the default that applies to all configured 'feeds', unless overwritten
    | for a specific feed configuration.
    |
    | Limits the number of entries returned in a feed.
    |
    */

    'limit' => 10,

    /*
    |--------------------------------------------------------------------------
    | DEFAULTS: Locales
    |--------------------------------------------------------------------------
    |
    | This is the default that applies to all configured 'feeds', unless overwritten
    | for a specific feed configuration.
    |
    | Limits the entries local to a list of locales, e. g.
    | 'locales' => ['com', 'uk']
    |
    | To include only the current locale, provide the special 'current' string:
    | 'locales' => 'current'
    |
    | When not set or null, all locales will be included.
    |
    */

    'locales' => null,

    'scope' => FeedScope::class,
];
