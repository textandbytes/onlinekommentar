<?php

namespace Textandbytes\Converter;

use HtmlToProseMirror\Marks;
use HtmlToProseMirror\Nodes;
use HtmlToProseMirror\Renderer;
use Statamic\Support\Str;
use Textandbytes\Converter\Marks\ParagraphNumber;
use Textandbytes\Converter\Nodes\Cleaner;
use Textandbytes\Converter\Nodes\Footnote;
use Textandbytes\Converter\Nodes\Heading;
use Textandbytes\Converter\Nodes\Text;

class Converter
{
    public function htmlToProsemirror($html)
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
        $data = (new Renderer)
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
                Heading::class,
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

        return json_encode($data);
    }

    public function prosemirrorToWord($data)
    {
        $data = json_decode($data);

        return (new WordRenderer)->render($data);
    }

    public function entryToWord($entry)
    {
        if ($entry->collection()->handle() === 'commentaries') {
            return $this->commentartyToWord($entry);
        }

        throw new \Exception('Not implemented');
    }

    public function commentartyToWord($entry)
    {
        $data = array_merge(
            $this->makeHeading($entry->title, 0),
            $entry->get('content'),
            $this->makeHeading('Assigned Authors', 1),
            $this->makeParagraph($entry->assigned_authors->pluck('name')->join(', ')),
            $this->makeHeading('Assigned Editors', 1),
            $this->makeParagraph($entry->assigned_editors->pluck('name')->join(', ')),
            $this->makeHeading('Suggested Citation', 1),
            $this->makeParagraph($entry->suggested_citation_long),
            $this->makeHeading('Legal Text', 1),
            $entry->get('legal_text'),
        );

        $data = json_decode(json_encode($data));

        return (new WordRenderer)->render($data);
    }

    protected function makeParagraph($text)
    {
        return [[
            'type' => 'paragraph',
            'content' => [
                ['type' => 'text', 'text' => $text],
            ],
        ]];
    }

    protected function makeHeading($text, $level)
    {
        return [[
            'type' => 'heading',
            'attrs' => ['level' => $level],
            'content' => [
                ['type' => 'text', 'text' => $text],
            ],
        ]];
    }
}
