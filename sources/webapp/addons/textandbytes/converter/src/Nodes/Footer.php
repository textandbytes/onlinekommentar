<?php

namespace Textandbytes\Converter\Nodes;

use HtmlToProseMirror\Nodes\Node;

class Footer extends Node
{
    public function matching()
    {
        /* Is this the div after the .WordSection1 div */
        return $this->DOMNode->previousSibling
            && $this->DOMNode->previousSibling->nodeName === 'div'
            && $this->DOMNode->previousSibling->getAttribute('class') === 'WordSection1';
    }

    public function data()
    {
        while ($this->DOMNode->hasChildNodes()) {
            $this->DOMNode->removeChild($this->DOMNode->firstChild);
        }

        return null;
    }
}
