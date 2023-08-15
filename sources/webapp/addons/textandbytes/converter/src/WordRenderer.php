<?php

namespace Textandbytes\Converter;

use HtmlToProseMirror\Renderer;
use PhpOffice\PhpWord\Element\TextRun;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpWord\SimpleType\Jc;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Style\Language;
use PhpOffice\PhpWord\Style\ListItem;
use Statamic\Support\Str;

class WordRenderer
{
    protected $word;

    public function __construct()
    {
        Settings::setOutputEscapingEnabled(true);

        $this->word = new PhpWord();
        $this->word->getSettings()->setThemeFontLang(new Language(Language::DE_DE));
        $this->defineStyles();
    }

    protected function defineStyles()
    {
        $this->word->setDefaultFontName('Times New Roman');
        $this->word->setDefaultFontSize(12);

        $this->word->addTitleStyle(0, [
            'size' => 24,
        ]);
        $this->word->addTitleStyle(1, [
            'size' => 22,
        ]);
        $this->word->addTitleStyle(2, [
            'size' => 20,
        ]);
        $this->word->addTitleStyle(3, [
            'size' => 18,
        ]);
        $this->word->addTitleStyle(4, [
            'size' => 16,
        ]);
        $this->word->addTitleStyle(5, [
            'size' => 14,
        ]);
        $this->word->addTitleStyle(6, [
            'size' => 12,
        ]);

        $this->word->setDefaultParagraphStyle([
            'spacing' => $this->lineHeight(1.08),
            'alignment' => Jc::BOTH,
            'indentation' => [
                'left' => $this->cm(1),
                'hanging' => $this->cm(1),
            ],
        ]);

        $this->word->addTableStyle('table', [
            'borderSize' => 1,
            'cellMargin' => $this->cm(0.1),
        ], [
            'bgColor' => 'EEEEEE',
        ]);

        $this->word->addTableStyle('table', [
            'size' => 10,
        ]);
    }

    public function render($data)
    {
        $this->renderSection($data, $this->word);

        $file = tempnam(sys_get_temp_dir(), 'PHPWord-');
        $this->word->save($file, 'Word2007');

        return $file;
    }

    protected function renderSection($nodes, $cursor)
    {
        $this->renderNodes($nodes, $cursor->addSection([
            'marginTop' => $this->cm(2.5),
            'marginLeft' => $this->cm(2.5),
            'marginRight' => $this->cm(2.5),
            'marginBottom' => $this->cm(2.5),
        ]));
    }

    protected function renderNodes($nodes, $cursor, ...$pass)
    {
        foreach ($nodes as $node) {
            $this->renderNode($node, $cursor, $pass);
        }
    }

    protected function renderNode($node, $cursor, $pass = [])
    {
        $method = 'render'.ucfirst(Str::camel($node->type));
        if (! method_exists($this, $method)) {
            return;
        }

        $this->$method($node, $cursor, ...$pass);
    }

    protected function renderHeading($node, $cursor)
    {
        $textRun = new TextRun();
        $this->renderNodes($node->content ?? [], $textRun);
        $cursor->addTitle($textRun, $node->attrs->level ?? 1);
        $cursor->addTextBreak();
    }

    protected function renderParagraph($node, $cursor)
    {
        if ($this->isParagraphWithNumber($node)) {
            return $this->renderParagraphWithNumber($node, $cursor);
        }

        $this->renderNodes($node->content ?? [], $cursor->addTextRun());
        $cursor->addTextBreak();
    }

    protected function renderParagraphWithNumber($node, $cursor)
    {
        $first = $node->content[0] ?? null;
        $second = $node->content[1] ?? null;

        $first->text = "#{$first->text}#\t";
        if ($second && $second->type === 'text') {
            $second->text = ltrim($second->text);
        }

        $this->renderNodes($node->content ?? [], $cursor->addTextRun());
        $cursor->addTextBreak();
    }

    protected function renderBulletList($node, $cursor, $level = 0)
    {
        $this->renderList($node, $cursor, $level, ['listType' => ListItem::TYPE_BULLET_FILLED]);
    }

    protected function renderOrderedList($node, $cursor, $level = 0)
    {
        $this->renderList($node, $cursor, $level, ['listType' => ListItem::TYPE_ALPHANUM]);
    }

    protected function renderList($node, $cursor, $level, $style)
    {
        foreach ($node->content ?? [] as $item) {
            $content = $item->content ?? [];
            $text = array_shift($content);
            $this->renderNodes($text->content ?? [], $cursor->addListItemRun($level, $style));
            $this->renderNodes($content ?? [], $cursor, $level + 1);
        }
        if ($level === 0) {
            $cursor->addTextBreak();
        }
    }

    protected function renderTable($node, $cursor)
    {
        $table = $cursor->addTable('table');
        foreach ($node->content ?? [] as $r => $row) {
            foreach ($row->content ?? [] as $c => $cell) {
                $colspan = $cell->attrs->colspan ?? 1;
                if ($colspan > 1) {
                    array_splice($row->content, $c + 1, 0, array_fill(0, $colspan - 1, (object) [
                        'type' => 'table_cell',
                        'attrs' => (object) [
                            'colspan' => -1,
                        ],
                    ]));
                }
            }
        }
        foreach ($node->content ?? [] as $r => $row) {
            foreach ($row->content ?? [] as $c => $cell) {
                $rowspan = $cell->attrs->rowspan ?? 1;
                if ($rowspan > 1 && isset($node->content[$r + 1]->content)) {
                    array_splice($node->content[$r + 1]->content, $c, 0, [(object) [
                        'type' => 'table_cell',
                        'attrs' => (object) [
                            'rowspan' => -1,
                        ],
                    ]]);
                }
            }
        }
        foreach ($node->content ?? [] as $row) {
            $table->addRow();
            foreach ($row->content ?? [] as $cell) {
                $colspan = $cell->attrs->colspan ?? 1;
                $rowspan = $cell->attrs->rowspan ?? 1;
                if ($colspan === -1) {
                    continue;
                }
                $content = $cell->content ?? [];
                $text = array_shift($content);
                $this->renderNodes($text->content ?? [], $table->addCell(null, [
                    'gridSpan' => $colspan > 1 ? $colspan : null,
                    'vMerge' => $rowspan > 1 ? 'restart' : ($rowspan === -1 ? 'continue' : null),
                ]));
            }
        }
        $cursor->addTextBreak();
    }

    protected function renderText($node, $cursor, $style = [])
    {
        if ($this->isLink($node)) {
            return $this->renderLink($node, $cursor);
        }

        $cursor->addText($node->text, $this->makeStyle($node, $style));
    }

    protected function renderHardBreak($node, $cursor)
    {
        $cursor->addTextBreak();
    }

    protected function renderLink($node, $cursor)
    {
        $mark = $this->findMark($node, 'link');
        $cursor->addLink($mark->attrs->href ?? '#', $node->text, $this->makeStyle($node));
    }

    protected function renderFootnote($node, $cursor)
    {
        $nodes = $this->parseFootnoteHtml($node->attrs->{'data-content'} ?? null);
        $this->renderNodes($nodes ?? [], $cursor->addFootnote(), [
            'size' => 10,
        ]);
    }

    protected function parseFootnoteHtml($html)
    {
        $nodes = collect((new Renderer)->render($html)['content'] ?? [])
            ->map(fn ($node) => array_merge($node['content'], [['type' => 'hardBreak']]))
            ->flatten(1)
            ->slice(0, -1)
            ->all();

        return json_decode(json_encode($nodes));
    }

    protected function isParagraphWithNumber($node)
    {
        $first = $node->content[0] ?? null;
        if (! $first || $first->type !== 'text') {
            return false;
        }

        $mark = $this->findMark($first, 'bts_span');
        if (! $mark || $mark->attrs->class !== 'paragraph-nr') {
            return false;
        }

        return true;
    }

    protected function isLink($node)
    {
        $mark = $this->findMark($node, 'link');
        if (! $mark) {
            return false;
        }

        return true;
    }

    protected function makeStyle($node, $style = [])
    {
        $marks = collect($node->marks ?? [])->map->type;

        if ($marks->contains('bold')) {
            $style['bold'] = true;
        }
        if ($marks->contains('italic')) {
            $style['italic'] = true;
        }
        if ($marks->contains('underline')) {
            $style['underline'] = Font::UNDERLINE_SINGLE;
        }
        if ($marks->contains('link')) {
            $style['color'] = '0000FF';
            $style['underline'] = Font::UNDERLINE_SINGLE;
        }

        return $style;
    }

    protected function findMark($node, $type)
    {
        return collect($node->marks ?? [])->first(fn ($mark) => $mark->type === $type);
    }

    protected function cm($value)
    {
        return Converter::cmToTwip($value);
    }

    protected function lineHeight($value)
    {
        return 240 * ($value - 1);
    }
}
