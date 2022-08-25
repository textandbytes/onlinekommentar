<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Commentary;
use App\Models\DocumentTree;
use Illuminate\Http\Request;
use Inertia\Inertia;
use TOC\MarkupFixer;
use TOC\TocGenerator;

class CommentariesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  String  $locale
     * @return \Illuminate\Http\Response
     */
    public function index($locale)
    {
        $commentaries = Commentary::all('id', 'slug', 'label_' . $locale)->toArray();

        return Inertia::render('Frontend/Commentaries', [
            'commentaries' => $commentaries
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $locale
     * @param  \App\Models\Commentary  $commentary
     * @return \Illuminate\Http\Response
     */
    public function show($locale, Commentary $commentary)
    {
        // generate formatted html markup for the language-specific 'content' field
        $content = $commentary['content_' . $locale];

        // add anchor attributes to the heading elements
        $markupFixer = new MarkupFixer();
        $contentMarkup = $markupFixer->fix($content);

        // generate table of contents from the heading elements
        $tocGenerator = new TocGenerator();
        $toc = $tocGenerator->getHtmlMenu($contentMarkup);

        return Inertia::render('Frontend/Commentary', [
            'document' => $commentary->document,
            'commentary' => $commentary,
            'tableOfContents' => $toc,
            'content' => $contentMarkup
        ]);
    }
}
