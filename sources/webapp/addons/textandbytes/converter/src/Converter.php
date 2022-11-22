<?php

namespace Textandbytes\Converter;

use HtmlToProseMirror\Marks;
use HtmlToProseMirror\Nodes;
use HtmlToProseMirror\Renderer;
use Statamic\Support\Str;
use Textandbytes\Converter\Marks\ParagraphNumber;
use Textandbytes\Converter\Nodes\Cleaner;
use Textandbytes\Converter\Nodes\Footnote;
use Textandbytes\Converter\Nodes\Text;

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
        $html = ParagraphNumber::prepare($html);

        /* Commented out extensions are the ones not enabled in the Bard field, 
           this will prevent output from containing unsupported nodes/marks */
        return (new Renderer)
            ->withMarks([
                ParagraphNumber::class,
                Marks\Bold::class,
                // Marks\Code::class,
                Marks\Italic::class,
                Marks\Link::class,
                // Marks\Strike::class,
                // Marks\Subscript::class,
                Marks\Superscript::class,
                Marks\Underline::class,
            ])
            ->withNodes([
                Cleaner::class,
                Footnote::class,
                // Nodes\Blockquote::class,
                Nodes\BulletList::class,
                // Nodes\CodeBlock::class,
                // Nodes\CodeBlockWrapper::class,
                Nodes\HardBreak::class,
                Nodes\Heading::class,
                // Nodes\HorizontalRule::class,
                // Nodes\Image::class,
                Nodes\ListItem::class,
                Nodes\OrderedList::class,
                Nodes\Paragraph::class,
                // Nodes\Table::class,
                // Nodes\TableCell::class,
                // Nodes\TableHeader::class,
                // Nodes\TableRow::class,
                // Nodes\TableWrapper::class,
                Text::class,
                // Nodes\User::class,
            ])
            ->render($html)['content'];
    }
}
