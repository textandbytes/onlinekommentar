<article class="commentary w-full border print:border-0">
  <commentary
    locale="{{ locale }}"
    :commentary="{{ commentary | to_json | entities }}"
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