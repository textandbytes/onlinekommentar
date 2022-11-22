<?php

namespace Textandbytes\Converter\Nodes;

use HtmlToProseMirror\Nodes\Node;
use Statamic\Support\Str;

class Cleaner extends Node
{
    public function matching()
    {
        return $this->isFooter()
            || $this->isEmptyParagraph()
            || $this->isTocAnchor();
    }

    public function data()
    {
        if (! $this->isTocAnchor()) {
            while ($this->DOMNode->hasChildNodes()) {
                $this->DOMNode->removeChild($this->DOMNode->firstChild);
            }
        }

        return null;
    }

    private function isFooter()
    {
        /* Is this the div after the .WordSection1 div */
        return $this->DOMNode->previousSibling
            && $this->DOMNode->previousSibling->nodeName === 'div'
            && $this->DOMNode->previousSibling->getAttribute('class') === 'WordSection1';
    }

    private function isEmptyParagraph()
    {
        /* Is this a paragraph that only contains a non-breaking space */
        return $this->DOMNode->nodeName === 'p'
            && $this->DOMNode->textContent === "\xc2\xa0";
    }

    private function isTocAnchor()
    {
        /* Is this a table of contents anchor */
        return $this->DOMNode->nodeName === 'a'
            && Str::startsWith($this->DOMNode->getAttribute('name'), '_Toc');
    }
}
