<?php

namespace Textandbytes\Converter;

use Statamic\Support\Str;
use Textandbytes\Converter\Marks\ParagraphNumber;
use Textandbytes\Converter\Nodes\Cleaner;
use Textandbytes\Converter\Nodes\Footnote;
use Tiptap\Editor;
use Tiptap\Marks;
use Tiptap\Nodes;

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

        $html = Cleaner::preConvert($html);
        $html = ParagraphNumber::preConvert($html);

        $data = (new Editor([
            'extensions' => [
                new Marks\Bold(),
                new Marks\Italic(),
                new Marks\Link(),
                new Marks\Superscript(),
                new Marks\Underline(),
                new Nodes\BulletList(),
                new Nodes\HardBreak(),
                new Nodes\Heading(),
                new Nodes\ListItem(),
                new Nodes\OrderedList(),
                new Nodes\Paragraph(),
                new Nodes\Document(),
                new Nodes\Text(),
                new Cleaner(),
                new Footnote(),
                new ParagraphNumber(),
            ],
        ]))->setContent($html)->getDocument()['content'];

        $data = Cleaner::postConvert($data);

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
            $entry->get('content') ?? [],
            $this->makeHeading('Assigned Authors', 1),
            $this->makeParagraph($entry->assigned_authors->pluck('name')->join(', ')),
            $this->makeHeading('Assigned Editors', 1),
            $this->makeParagraph($entry->assigned_editors->pluck('name')->join(', ')),
            $this->makeHeading('Suggested Citation', 1),
            $this->makeParagraph($entry->suggested_citation_long),
            $this->makeHeading('Legal Text', 1),
            $entry->get('legal_text') ?? [],
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
