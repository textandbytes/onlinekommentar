<?php

use Statamic\Facades\Entry; 

// get the list of commentaries that have valid content
$commentaries = Entry::query()
  ->where('collection', 'commentaries')
  ->where('locale', app()->getLocale())
  ->where('status', 'published')
  ->get()
  ->map(function ($commentary, $key) {
    if ($commentary['content'] !== null) {
      return [
        'id' => $commentary['id'],
        'slug' => $commentary['slug'],
        'title' => $commentary['title'],
        'legal_domain' => Entry::query()
            ->where('collection', 'legal_domains')
            ->where('id', $commentary->value('legal_domain'))
            ->get()
            ->map(function ($legal_domain, $key) {
                return [
                  'id' => $legal_domain['id'],
                  'label' => __($legal_domain['title'])
                ];
            })
            ->first(),
        'assigned_authors' => $commentary['assigned_authors']->map(function ($author, $key) {
          return $author['name'];
        })->toArray(),
        'assigned_editors' => $commentary['assigned_editors']->map(function ($editor, $key) {
          return $editor['name'];
        })->toArray(),
      ];
    }
  })
  ->filter()
  ->toArray();

  // sort the commentaries by the label of the legal domain
  usort($commentaries, fn($obj1, $obj2) => 
    strcmp(
      $obj1['legal_domain']
        ? str_replace(array('Ä', 'Ö', 'Ü'), array('Ae', 'Oe', 'Ue'), strtoupper($obj1['legal_domain']['label']))
        : '',
      $obj2['legal_domain']
        ? str_replace(array('Ä', 'Ö', 'Ü'), array('Ae', 'Oe', 'Ue'), strtoupper($obj2['legal_domain']['label']))
        : ''
    )
  );

  // get the non-null, unique legal domains from the list of commentaries
  // reset the array index values to return an indexed array instead of an associative array
  $legalDomains = array_values(array_unique(array_filter(array_column($commentaries, 'legal_domain')), SORT_REGULAR));
  // prepend an option to display all legal domains
  array_unshift($legalDomains, ['id' => null, 'label' => __('legal_domain_filter_label') . ': ' . __('legal_domain_filter_all')]);
?>

<commentaries
  locale="{{ locale }}"
  :commentaries='<?= json_encode($commentaries, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
  :legal-domains='<?= json_encode($legalDomains, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT) ?>'>
</commentaries>