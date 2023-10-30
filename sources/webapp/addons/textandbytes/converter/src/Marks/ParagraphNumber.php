<?php

namespace Textandbytes\Converter\Marks;

use Tiptap\Core\Mark;

class ParagraphNumber extends Mark
{
    public static $name = 'btsSpan';

    public static $priority = 1500;

    public function addAttributes()
    {
        return [
            'class' => [],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'getAttrs' => function ($DOMNode) {
                    $matches = $DOMNode->nodeName === 'span'
                        && $DOMNode->getAttribute('class') === 'paragraph-nr';

                    if (! $matches) {
                        return false;
                    }

                    return [
                        'class' => 'paragraph-nr',
                    ];
                },
            ],
        ];
    }

    public static function preConvert($html)
    {
        /* ProseMirror needs these to be seperate DOMNodes so convert to spans */
        return preg_replace('/#([0-9]+)#/u', '<span class="paragraph-nr">$1</span>', $html);
    }
}
