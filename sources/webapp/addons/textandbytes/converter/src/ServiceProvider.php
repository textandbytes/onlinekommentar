<?php

namespace Textandbytes\Converter;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $fieldtypes = [
        Fieldtypes\Converter::class,
    ];
    
    protected $scripts = [
        __DIR__ . '/../dist/js/addon.js',
    ];

    public function bootAddon()
    {
        //
    }
}
