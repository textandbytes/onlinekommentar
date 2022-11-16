<?php

namespace App\Converters\Nodes;

use DOMXPath;
use HtmlToProseMirror\Nodes\Node;
use Statamic\Support\Str;

class Footnote extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'a'
            && Str::startsWith($this->DOMNode->getAttribute('href'), '#_ftn');
    }

    public function data()
    {
        while ($this->DOMNode->hasChildNodes()) {
            $this->DOMNode->removeChild($this->DOMNode->firstChild);
        }

        $href = $this->DOMNode->getAttribute('href');
        $id = Str::after($href, '#_');

        /* Fetch the content of the matching .MsoFootnoteText paragraph excluding
           the first node which is the .MsoFootnoteReference element */
        $nodes = (new DOMXPath($this->DOMNode->ownerDocument))
            ->query('//div[@id="'.$id.'"]/p[@class="MsoFootnoteText"]/node()[position()>1]');
        $html = collect($nodes)
            ->map(fn ($node) => $node->ownerDocument->saveHTML($node))
            ->join('');

        return [
            'type' => 'footnote',
            'attrs' => [
                'data-content' => Str::collapseWhitespace($html),
            ],
        ];
    }
}