<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Cache;
use Statamic\Events\EntrySaved;
use Statamic\Facades\Site;

class ClearNavCache
{
    public function handle(EntrySaved $event): void
    {
        if ($event->entry->collectionHandle() !== 'commentaries') {
            return;
        }

        foreach (Site::all() as $site) {
            $key = 'nav-'.$site->handle();
            Cache::forget($key);
        }
    }
}
