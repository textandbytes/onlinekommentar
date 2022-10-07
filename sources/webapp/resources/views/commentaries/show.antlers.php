<?php
    use Statamic\Facades\Entry;
    use Illuminate\Support\Facades\Request;
    use TOC\MarkupFixer;
    use TOC\TocGenerator;

    // var_dump(); exit();

    $entry = Entry::query()
        ->where('collection', 'commentaries')
        ->where('slug', Request::segment(count(Request::segments()))) // get the last slug from the URL
        ->get(['content']);

    // generate formatted html markup for the language-specific 'content' field
    $content = $entry[0]['content'];

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
?>

<article class="commentary w-full border">
    <commentary :commentary="{
        'title': '{{ title }}',
        'legal_text': '{{ legal_text }}',
        'suggested_citation_long': '{{ suggested_citation_long }}',
        'suggested_citation_short': '{{ suggested_citation_short }}',
        'original_language': '{{ original_language ?? 'de' }}',
        'locale': '{{ locale }}',
        'pdf_commentary_path': '<?= Storage::url('commentaries/pdf/') ?>',
        'pdf_commentary_filename': '{{ pdf_commentary:basename }}',
    }">
        <template v-slot:table-of-contents>
            <?= $toc ?>
        </template>
        <template v-slot:content>
            <?= $contentMarkup ?>
        </template>
    </commentary>
</article>