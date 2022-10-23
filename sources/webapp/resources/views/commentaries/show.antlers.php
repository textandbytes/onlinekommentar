<article class="commentary w-full border">
  <commentary
    locale="{{ locale }}"
    :commentary="{
      id: '{{ id }}',
      slug: '{{ slug }}',
      title: '{{ title }}',
      assigned_editors: [
        {{ assigned_editors }}
          '{{ name }}',
        {{ /assigned_editors }}
      ],
      assigned_authors: [
        {{ assigned_authors }}
          '{{ name }}',
        {{ /assigned_authors }}
      ],
      legal_text: '{{ legal_text }}',
      suggested_citation_long: '{{ suggested_citation_long }}',
      suggested_citation_short: '{{ suggested_citation_short }}',
      original_language: '{{ original_language ?? 'de' }}',
      locale: '{{ locale }}',
      pdf_commentary_path: '<?= Storage::url('commentaries/pdf/') ?>',
      pdf_commentary_filename: '{{ pdf_commentary:basename }}',
    }"
    :versions="[
      {{ revisions:commentary :id='id' :locale='locale' }}
        {
          id: '{{ unix_timestamp }}',
          timestamp: '{{ unix_timestamp }}',
          label: '{{ human_readable_timestamp }}'
        },
      {{ /revisions:commentary }}
    ]"
    version-timestamp="{{ versionTimestamp }}">
    <template v-slot:table-of-contents>
      {{ toc }}
    </template>

    <template v-slot:content>
      {{ contentMarkup }}
    </template>
  </commentary>
</article>