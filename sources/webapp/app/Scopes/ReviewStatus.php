<?php
 
namespace App\Scopes;
 
use Statamic\Facades\User;
use Statamic\Query\Scopes\Filter;
 

class ReviewStatus extends Filter
{
    public $pinned = true;

    public function fieldItems()
    {
        return [
            'review_status' => [
                'type' => 'radio',
                'options' => [
                    'draft' => __('Draft'),
                    'ready_to_review' => __('Ready to Review'),
                    'approved' => __('Approved'),
                ]
            ]
        ];
    }
 
    public function apply($query, $values)
    {
        $query->where('review_status', '=', $values['review_status']);
    }
 
    public function badge($values)
    {
        return 'Review Status: ' . $this->fieldItems('review_status')['review_status']['options'][$values['review_status']];
    }
 
    public function visibleTo($key)
    {
        return $key === 'entries' && $this->context['collection'] == 'commentaries';
    }
}