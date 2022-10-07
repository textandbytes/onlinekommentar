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
        <template v-slot:content>
            {{ content }}
        </template>
    </commentary>
</article>