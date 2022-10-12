<?php

use Statamic\Facades\Entry; 

// get the list of commentaries that have valid content
$commentaries = Entry::query()
  ->where('collection', 'commentaries')
  ->where('locale', app()->getLocale())
  ->get()
  ->map(function ($commentary, $key) {
    if ($commentary['content'] !== null) {
      return [
        'id' => $commentary['id'],
        'slug' => $commentary['slug'],
        'title' => $commentary['title'],
        'legal_domain' => Entry::query()
            ->where('collection', 'legal_domains')
            ->where('locale', app()->getLocale())
            ->where('id', $commentary->value('legal_domain'))
            ->get()
            ->map(function ($legal_domain, $key) {
                return $legal_domain['title'];
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
  ->toArray();

  // remove null values that occur for commentary entries with no content
  // reset the array index values to return an indexed array instead of an associative array
  $commentaries = array_values(array_filter($commentaries));
  // sort the commentaries by legal domain
  usort($commentaries, fn($obj1, $obj2) => strcmp($obj1['legal_domain'], $obj2['legal_domain']));

  // get the non-null, unique legal domains from the list of commentaries
  // reset the array index values to return an indexed array instead of an associative array
  $legalDomains = array_values(array_unique(array_filter(array_column($commentaries, 'legal_domain'))));
?>

<commentaries
  locale="{{ locale }}"
  :commentaries='<?= json_encode($commentaries, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT) ?>'
  :legal-domains='<?= json_encode($legalDomains, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT) ?>'>
</commentaries>