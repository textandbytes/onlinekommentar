<article class="commentary w-full border print:border-0">
  <commentary
    locale="{{ locale }}"
    base-path-prefix="{{ base_path_prefix }}"
    :commentary="{
      id: '{{ id }}',
      slug: '{{ slug }}',
      title: '{{ title }}',
      doi: '{{ doi }}',
      date: '{{ date iso_format="DD.MM.YYYY" }}',
      assigned_editors: [
        {{ foreach:assigned_editors as="assigned_editor" }}
          {
            {{ foreach:assigned_editor }}
              '{{ key }}': '{{ value | add_slashes | sanitize:true }}',
            {{ /foreach:assigned_editor }}
          },
        {{ /foreach:assigned_editors }}
      ],
      assigned_authors: [
        {{ foreach:assigned_authors as="assigned_author" }}
          {
            {{ foreach:assigned_author }}
              '{{ key }}': '{{ value | add_slashes | sanitize:true }}',
            {{ /foreach:assigned_author }}
          },
        {{ /foreach:assigned_authors }}
      ],
      legal_text: '{{ legal_text | add_slashes | sanitize:true }}',
      suggested_citation_long: '{{ suggested_citation_long | add_slashes | sanitize:true }}',
      suggested_citation_short: '{{ suggested_citation_short | add_slashes | sanitize:true }}',
      original_language: '{{ original_language }}',
      locale: '{{ locale }}',
      pdf_commentary_path: '<?php echo Storage::url('commentaries/pdf/') ?>',
      pdf_commentary_filename: '{{ pdf_commentary:basename }}',
      additional_documents: {{ additional_documents | to_json | sanitize:true }},
    }"
    :versions="[
      {{ revisions:commentary :id='id' :locale='locale' }}
        {
          id: '{{ unix_timestamp }}',
          timestamp: '{{ unix_timestamp }}',
          label: '{{ human_readable_timestamp }}',
          label_date_only: '{{ human_readable_timestamp_date_only }}'
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

  {{ if versionComparisonResult }}
    <version-comparison-modal-dialog
      locale="{{ locale }}"
      :commentary="{
        slug: '{{ slug }}',
      }"
      version-timestamp="{{ versionTimestamp }}"
      :open="true">
      <template v-slot:title>
        {{ $t('compare_versions') }}
      </template>
      <template v-slot:body>
        <div class="prose max-w-full version-comparison">
          {{ versionComparisonResult }}
        </div>
      </template>
    </version-comparison-modal-dialog>
  {{ /if }}
</article>