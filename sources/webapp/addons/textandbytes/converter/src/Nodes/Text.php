<?php

namespace Textandbytes\Converter\Nodes;

use HtmlToProseMirror\Nodes\Text as DefaultText;

class Text extends DefaultText
{
    public function data()
    {
        /* Word adds extra line breaks that ProseMirror mistakenly converts to
           <br> tags, so collapse whitespce while keeping leading/trailing spaces */
        $text = preg_replace('/\s+/u', ' ', $this->DOMNode->nodeValue);

        if ($text === '') {
            return null;
        }

        return [
            'type' => 'text',
            'text' => $text,
        ];
    }
}
