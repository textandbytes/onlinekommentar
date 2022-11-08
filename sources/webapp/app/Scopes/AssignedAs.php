<?php
 
namespace App\Scopes;
 
use Statamic\Facades\User;
use Statamic\Query\Scopes\Filter;
 

class AssignedAs extends Filter
{
    public $pinned = true;

    public function fieldItems()
    {
        return [
            'assigned_as' => [
                'type' => 'radio',
                'options' => [
                    'author' => __('Author'),
                    'editor' => __('Editor'),
                    'both' => __('Editor or Author'),
                ]
            ]
        ];
    }
 
    public function autoApply()
    {
        // automatically apply this filter if the user is a contributor
        if (User::current()->toArray()['is_contributor']) {
            return [
                'assigned_as' => 'both',
            ];
        }
    }
 
    public function apply($query, $values)
    {
        if($values['assigned_as'] == 'author') {
            $query->whereJsonContains('assigned_authors', User::current()->id);
        } elseif($values['assigned_as'] == 'editor') {
            $query->whereJsonContains('assigned_editors', User::current()->id);
        } elseif($values['assigned_as'] == 'both') {
            $query->whereJsonContains('assigned_authors', User::current()->id)
                  ->orWhereJsonContains('assigned_editors', User::current()->id);
        }
    }
 
    public function badge($values)
    {
        return 'Assigned as ' . $this->fieldItems('assigned_as')['assigned_as']['options'][$values['assigned_as']];
    }
 
    public function visibleTo($key)
    {
        return $key === 'entries' && $this->context['collection'] == 'commentaries';
    }
}