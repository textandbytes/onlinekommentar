<?php

namespace App\Entries;

use Statamic\Entries\Collection as StatamicCollection;

class Collection extends StatamicCollection
{
    // Workaround for this issue: https://github.com/statamic/cms/issues/9012
    public function augmentedArrayData()
    {
        $data = [
            'title' => $this->title(),
            'handle' => $this->handle(),
        ];

        // if (! Statamic::isApiRoute() && ! Statamic::isCpRoute()) {
        //     $data['mount'] = $this->mount();
        // }

        return $data;
    }
}
