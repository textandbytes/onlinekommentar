<?php

namespace App\Tags;

use Illuminate\Support\Facades\Cache;
use Statamic\Facades\Site;
use Statamic\Facades\URL;
use Statamic\Tags\Nav as StatamicNav;

class Nav extends StatamicNav
{
    public function cached()
    {
        $key = 'nav-'.Site::current()->handle();

        $items = Cache::rememberForever($key, function () {
            return $this->parseItems(parent::index());
        });

        return $this->hydrateItems($items);
    }

    protected function parseItems($items)
    {
        return collect($items)->map(function ($item) {
            return [
                'title' => $item['title']->value(),
                'url' => $item['url']->value(),
                'depth' => $item['depth'],
                'children' => $this->parseItems($item['children']),
                'is_current' => false,
                'is_parent' => false,
            ];
        })->all();
    }

    protected function hydrateItems($items)
    {
        $currentUrl = URL::getCurrent();

        return collect($items)->map(function ($item) use ($currentUrl) {
            $children = $this->hydrateItems($item['children']);
            $isParent = collect($children)->contains(function ($child) {
                return $child['is_current'] || $child['is_parent'];
            });

            return array_merge($item, [
                'is_current' => $item['url'] === $currentUrl,
                'is_parent' => $isParent,
                'children' => $children,
            ]);
        })->all();
    }
}
