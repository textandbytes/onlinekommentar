<?php

namespace App\Scopes;

use Statamic\Query\Scopes\Scope;

class FeedScope extends Scope
{
    public function apply($query, $values)
    {
        $query->whereNotNull('content');
    }
}
