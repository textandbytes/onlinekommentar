<?php

namespace App\Fieldtypes\Bard\Nodes;

use Tiptap\Nodes\Paragraph as TiptapParagraph;

class Paragraph extends TiptapParagraph
{
    public function renderHTML($node, $HTMLAttributes = [])
    {
        $value = parent::renderHTML($node, $HTMLAttributes);

        if ($number = $this->number($node)) {
            $value[1]['id'] = 'p'.$number;
        }

        return $value;
    }

    protected function number($node)
    {
        if (! $node = $node->content[0] ?? null) {
            return;
        }

        if ($node->type !== 'text') {
            return;
        }

        if (! $mark = $node->marks[0] ?? null) {
            return;
        }

        if ($mark->type !== 'btsSpan' || $mark->attrs->class !== 'paragraph-nr') {
            return;
        }

        return trim($node->text);
    }
}
