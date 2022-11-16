<?php

namespace App\Converters;

use HtmlToProseMirror\Renderer;
use Statamic\Support\Str;

class Converter
{
    public function convert($html)
    {
        /* ProseMirror input must be UTF-8. Samples coming from tests will be
           but if we're processing a Word HTML file we need to convert it first */
        if (Str::contains($html, 'charset=windows-1252')) {
            $html = mb_convert_encoding($html, 'utf-8', 'windows-1252');
            $html = str_replace('charset=windows-1252', 'charset=utf-8', $html);
        }

        /* Run the source HTML through any extension prepare methods */
        $html = Marks\ParagraphNumber::prepare($html);

        return (new Renderer)
            ->addMarks([
                Marks\ParagraphNumber::class,
            ])
            ->addNodes([
                Nodes\Footnote::class,
                Nodes\Footer::class,
            ])
            ->render($html)['content'];
    }
}
