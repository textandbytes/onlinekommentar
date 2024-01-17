<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;
use Textandbytes\Converter\Converter;

class ConverterTest extends TestCase
{
    /** @test */
    public function it_converts_footnotes()
    {
        $html = <<<'EOT'
<div class=WordSection1>

<p class=MsoNormal>Überschriften der ersten Gliederungsebene werden durch
römische Zahlen gegliedert.<a href="#_ftn1" name="_ftnref1" title=""><span
class=MsoFootnoteReference><span class=MsoFootnoteReference><span
style='font-size:12.0pt;line-height:107%;font-family:"Times New Roman",serif'>[1]</span></span></span></a></p>

</div>

<div>

<div id=ftn1>

<p class=MsoFootnoteText style='margin-left:1.0cm;text-indent:-1.0cm'><a
href="#_ftnref1" name="_ftn1" title=""><span class=MsoFootnoteReference><span
class=MsoFootnoteReference><span style='font-size:10.0pt;line-height:107%;
font-family:"Times New Roman",serif'>[1]</span></span></span></a>           BSK-<span
style='text-transform:uppercase'>Dubs/Truffer</span>, N. 1 zu Art. 701 OR. Hier
gibt es auch <i>Kursivschrift</i> und <b>Fettschrift</b>.</p>

</div>

</div>
EOT;

        $expected = [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Überschriften der ersten Gliederungsebene werden durch römische Zahlen gegliedert.',
                    ],
                    [
                        'type' => 'footnote',
                        'attrs' => [
                            'data-content' => 'BSK-Dubs/Truffer, N. 1 zu Art. 701 OR. Hier gibt es auch <i>Kursivschrift</i> und <b>Fettschrift</b>.',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $this->convert($html));
    }

    /** @test */
    public function it_converts_footnotes_alt_class()
    {
        $html = <<<'EOT'
<div class=WordSection1>

<p class=MsoNormal style='margin-top:0cm;margin-right:0cm;margin-bottom:0cm;
margin-left:1.0cm;text-align:justify;text-indent:-1.0cm;border:none'><span
style='font-size:12.0pt;line-height:107%;font-family:"Times New Roman",serif;
color:black'>Infolge des Territorialitätsprinzips entfalten gerichtliche
Entscheide als staatliche Hoheitsakte ausschliesslich Rechtsfolgen im
Urteilsstaat.<a href="#_ftn1" name="_ftnref1" title=""><sup><sup><span
style='font-size:12.0pt;line-height:107%;font-family:"Times New Roman",serif;
color:black'>[1]</span></sup></sup></a></p>

</div>

<div>

<div id=ftn1>

<p class=MsoNormal style='margin-bottom:0cm;line-height:normal;border:none'><a
href="#_ftnref1" name="_ftn1" title=""><sup><span style='font-size:10.0pt;
font-family:"Times New Roman",serif'><sup><span style='font-size:10.0pt;
line-height:107%;font-family:"Times New Roman",serif'>[1]</span></sup></span></sup></a><span
style='font-size:10.0pt;font-family:"Times New Roman",serif;color:black'>
Spühler/Rodriguez, Rz. 323; Linke/Hau, Rz. 12.1; Donzallaz, Rz. 1749 f.;
Matscher, S. 265. </span></p>

</div>

</div>
EOT;

        $expected = [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Infolge des Territorialitätsprinzips entfalten gerichtliche Entscheide als staatliche Hoheitsakte ausschliesslich Rechtsfolgen im Urteilsstaat.',
                    ],
                    [
                        'type' => 'footnote',
                        'attrs' => [
                            'data-content' => 'Spühler/Rodriguez, Rz. 323; Linke/Hau, Rz. 12.1; Donzallaz, Rz. 1749 f.; Matscher, S. 265.',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $this->convert($html));
    }

    /** @test */
    public function it_converts_paragraph_numbers()
    {
        $html = <<<'EOT'
<div class=WordSection1>

<p class=MsoNormal>#1# Überschriften der ersten Gliederungsebene werden durch
römische Zahlen gegliedert.</p>

</div>
EOT;

        $expected = [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => '1',
                        'marks' => [
                            [
                                'type' => 'btsSpan',
                                'attrs' => [
                                    'class' => 'paragraph-nr',
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'text',
                        'text' => ' Überschriften der ersten Gliederungsebene werden durch römische Zahlen gegliedert.',
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $this->convert($html));
    }

    /** @test */
    public function it_removes_toc_anchors()
    {
        $html = <<<'EOT'
<h1><a name="_Toc88908065"></a><a name="_Toc90035648">I.<span style='font:7.0pt "Times New Roman"'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span>Überschrift 1</a></h1>
EOT;

        $expected = [
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 1,
                ],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'I. Überschrift 1',
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $this->convert($html));
    }

    /** @test */
    public function it_removes_empty_paragraphs()
    {
        $html = <<<'EOT'
<p class=MsoNormal>&nbsp;</p><o:p></o:p>
EOT;

        $this->assertEquals([], $this->convert($html));
    }

    /** @test */
    public function it_removes_footer()
    {
        $html = <<<'EOT'
<div class=WordSection1>
<p>Body</p>
</div>
<div>
<p>Footer</p>
</div>
EOT;

        $this->assertNotContains([
            'type' => 'paragraph',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Footer',
                ],
            ],
        ], $this->convert($html));
    }

    /** @test1 */
    public function it_converts_sample()
    {
        $html = file_get_contents(__DIR__.'/__fixtures__/documents/sample.html');

        $expected = Yaml::parse(file_get_contents(__DIR__.'/__fixtures__/documents/sample.yaml'));

        $this->assertEquals($expected, $this->convert($html));
    }

    private function convert($html)
    {
        return json_decode((new Converter)->htmlToProsemirror($html), true);
    }
}
