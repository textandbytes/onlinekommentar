<?php

namespace Tests;

use Textandbytes\Converter\Converter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

class ConverterTest extends TestCase
{
    /** @test */
    public function it_converts_footnotes()
    {
        $html = <<<EOT
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
                        'text' => "Überschriften der ersten Gliederungsebene werden durch römische Zahlen gegliedert.",
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
    public function it_converts_paragraph_numbers()
    {
        $html = <<<EOT
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
                                'type' => 'bts_span',
                                'attrs' => [
                                    'class' => 'paragraph-nr',
                                ],
                            ]
                        ],
                    ],
                    [
                        'type' => 'text',
                        'text' => " Überschriften der ersten Gliederungsebene werden durch römische Zahlen gegliedert.",
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $this->convert($html));
    }

    /** @test */
    public function it_removes_toc_anchors()
    {
        $html = <<<EOT
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
                        'text' => "I.",
                    ],
                    [
                        'type' => 'text',
                        'text' => " ",
                    ],
                    [
                        'type' => 'text',
                        'text' => "Überschrift 1",
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $this->convert($html));
    }

    /** @test */
    public function it_removes_empty_paragraphs()
    {
        $html = <<<EOT
<p class=MsoNormal>&nbsp;</p>
EOT;

        $this->assertEquals([], $this->convert($html));
    }

    /** @test */
    public function it_removes_footer()
    {
        $html = <<<EOT
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
                    'text' => "Footer",
                ],
            ],
        ], $this->convert($html));
    }

    /** @test */
    public function it_converts_sample()
    {
        $html = file_get_contents(__DIR__ . '/__fixtures__/documents/sample.html');

        // file_put_contents(__DIR__ . '/__fixtures__/documents/sample.yaml', Yaml::dump($this->convert($html), 10));
        $expected = Yaml::parse(file_get_contents(__DIR__ . '/__fixtures__/documents/sample.yaml'));

        $this->assertEquals($expected, $this->convert($html));
    }

    private function convert($html)
    {
        return (new Converter)->convert($html);
    }
}
