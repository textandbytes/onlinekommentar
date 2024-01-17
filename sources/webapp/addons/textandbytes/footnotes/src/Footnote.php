<?php

namespace Textandbytes\Footnotes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class Footnote extends Node
{
    public static $name = 'footnote';

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [],
        ];
    }

    public function addAttributes()
    {
        return [
            'data-content' => [],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        return ['footnote', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes)];
    }
}
