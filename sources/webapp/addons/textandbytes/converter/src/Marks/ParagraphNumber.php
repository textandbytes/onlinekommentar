<?php

namespace Textandbytes\Converter\Marks;

use HtmlToProseMirror\Marks\Mark;

class ParagraphNumber extends Mark
{
    public static function prepare($html)
    {
        /* ProseMirror needs these to be seperate DOMNodes so convert to spans */
        return preg_replace('/#([0-9]+)#/u', '<span class="paragraph-nr">$1</span>', $html);
    }

    public function matching()
    {
        return $this->DOMNode->nodeName === 'span'
            && $this->DOMNode->getAttribute('class') === 'paragraph-nr';
    }

    public function data()
    {
        return [
            'type' => 'bts_span',
            'attrs' => [
                'class' => 'paragraph-nr',
            ],
        ];
    }
}
