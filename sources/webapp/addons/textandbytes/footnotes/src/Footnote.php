<?php

namespace Textandbytes\Footnotes;

use ProseMirrorToHtml\Nodes\Node;

class Footnote extends Node
{
    protected $nodeType = 'footnote';

    protected $tagName = 'footnote';

    public function matching(): bool
    {
        return $this->node->type === $this->nodeType;
    }

    public function tag(): ?array
    {
        return [
            [
                'tag' => 'footnote',
                'attrs' => [
                    'data-content' => e($this->node->attrs->{'data-content'}),
                ],
            ],
        ];
    }
}
