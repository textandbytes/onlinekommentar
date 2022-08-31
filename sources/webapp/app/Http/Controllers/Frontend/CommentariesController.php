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
        $commentaryGroups = Commentary::with('document')
            ->get()
            ->groupBy('document.label_' . $locale)
            ->map(function ($group) use ($locale) {
                return $group->map(function ($commentary) use ($locale) {
                    return [
                        'id' => $commentary->id,
                        'document_label' => $commentary->document ? $commentary->document->{'label_' . $locale} : null,
                        'label' => $commentary->{'label_' . $locale}
                    ];
                })->toArray();
            })
            ->toArray();

        return Inertia::render('Frontend/Commentaries', [
            'commentaryGroups' => $commentaryGroups
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
        $contentMarkup = null;
        if ($content) {
            $markupFixer = new MarkupFixer();
            $contentMarkup = $markupFixer->fix($content);
        }

        // generate table of contents from the heading elements
        $toc = null;
        if ($contentMarkup) {
            $tocGenerator = new TocGenerator();
            $toc = $tocGenerator->getHtmlMenu($contentMarkup);
        }


        return Inertia::render('Frontend/Commentary', [
            'document' => $commentary->document,
            'commentary' => $commentary,
            'content' => $contentMarkup,
            'tableOfContents' => $toc,
            'versions' => null
        ]);
    }
}
