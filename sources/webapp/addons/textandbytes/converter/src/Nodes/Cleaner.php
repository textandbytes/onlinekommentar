<?php

namespace Textandbytes\Converter\Nodes;

use Tiptap\Core\Node;

class Cleaner extends Node
{
    public static $name = 'cleaner';

    public static $priority = 2000;

    public function parseHTML()
    {
        return [
            [
                'getAttrs' => function ($DOMNode) {
                    $matches = $this->isFooter($DOMNode)
                        || $this->isEmptyParagraph($DOMNode);

                    if (! $matches) {
                        return false;
                    }

                    while ($DOMNode->hasChildNodes()) {
                        $DOMNode->removeChild($DOMNode->firstChild);
                    }
                },
            ],
        ];
    }

    private function isFooter($DOMNode)
    {
        /* Is this the div after the .WordSection1 div */
        return $DOMNode->previousSibling
            && $DOMNode->previousSibling->nodeName === 'div'
            && $DOMNode->previousSibling->getAttribute('class') === 'WordSection1';
    }

    private function isEmptyParagraph($DOMNode)
    {
        /* Is this an empty paragraph */
        return $DOMNode->nodeName === 'p'
            && trim($DOMNode->textContent) === '';
    }

    public static function preConvert($html)
    {
        /* Collapse all whitespce while keeping leading/trailing spaces */
        return preg_replace('/(\s|&nbsp;)+/u', ' ', $html);
    }

    public static function postConvert($data)
    {
        /* Tiptap will leave empty cleaner nodes behind that need to be removed */
        foreach ($data as $i => $node) {
            if ($node['type'] === 'cleaner') {
                unset($data[$i]);
            }
            if ($node['content'] ?? false) {
                $node['content'] = self::postConvert($node['content']);
            }
        }

        return array_values($data);
    }
}
