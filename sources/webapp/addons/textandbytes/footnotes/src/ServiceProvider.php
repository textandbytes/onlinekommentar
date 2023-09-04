<?php

namespace Textandbytes\Footnotes;

use Statamic\Fieldtypes\Bard\Augmentor;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $scripts = [
        __DIR__.'/../dist/js/footnotes.js',
    ];

    protected $stylesheets = [
        __DIR__.'/../dist/css/footnotes.css',
    ];

    public function bootAddon()
    {
        parent::boot();
        Augmentor::addNode(Footnote::class);
    }
}
