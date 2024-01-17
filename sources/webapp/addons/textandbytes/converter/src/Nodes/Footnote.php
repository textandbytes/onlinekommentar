<?php

namespace Textandbytes\Converter\Nodes;

use DOMXPath;
use Statamic\Support\Str;
use Tiptap\Core\Node;

class Footnote extends Node
{
    public static $name = 'footnote';

    public static $priority = 1500;

    public function addAttributes()
    {
        return [
            'data-content' => [],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'getAttrs' => function ($DOMNode) {
                    $matches = $DOMNode->nodeName === 'a'
                        && Str::startsWith($DOMNode->getAttribute('href'), '#_ftn');

                    if (! $matches) {
                        return false;
                    }

                    while ($DOMNode->hasChildNodes()) {
                        $DOMNode->removeChild($DOMNode->firstChild);
                    }

                    $href = $DOMNode->getAttribute('href');
                    $id = Str::after($href, '#_');

                    /* Fetch the content of the matching paragraph excluding
                    the first node which is the .MsoFootnoteReference element */
                    $nodes = (new DOMXPath($DOMNode->ownerDocument))
                        ->query('//div[@id="'.$id.'"]/p/node()[position()>1]');
                    $html = collect($nodes)
                        ->map(fn ($node) => $node->ownerDocument->saveHTML($node))
                        ->join('');

                    return [
                        'data-content' => Str::collapseWhitespace(strip_tags($html, ['b', 'i', 'u', 'em', 'strong', 'sup', 'a'])),
                    ];
                },
            ],
        ];
    }
}
