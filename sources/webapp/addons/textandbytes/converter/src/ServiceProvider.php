<?php

namespace Textandbytes\Converter;

use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $fieldtypes = [
        Fieldtypes\Converter::class,
    ];

    protected $commands = [
        Commands\ImportDocuments::class,
    ];
    
    protected $routes = [
        'cp'  => __DIR__.'/../routes/cp.php',
    ];
    
    protected $scripts = [
        __DIR__ . '/../dist/js/addon.js',
    ];

    public function bootAddon()
    {
        //
    }
}
