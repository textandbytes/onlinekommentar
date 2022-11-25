<?php

namespace Textandbytes\Converter\Nodes;

use HtmlToProseMirror\Nodes\Heading as DefaultHeading;

class Heading extends DefaultHeading
{
    public function data()
    {
        $data = parent::data();

        $data['attrs']['level'] = (int) $data['attrs']['level'];

        return $data;
    }
}
