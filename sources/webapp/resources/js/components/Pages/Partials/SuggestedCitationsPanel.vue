<template>
  <div class="text-xs text-gray-800 space-y-4 print:space-y-0">
    <div class="print:pt-2" v-html="citationTextLong"></div>

    <CopyTextButton
      :label="$t('copy_citation')"
      :text="citationTextLongPrint"
      class="flex items-center justify-end print:hidden"
    />

    <div class="border-t border-black pt-2 print:border-none print:pt-2">
      {{ $t('short_citation') }}: {{ commentary.suggested_citation_short }}
    </div>

    <CopyTextButton
      :label="$t('copy_citation')"
      :text="citationTextShort"
      class="flex items-center justify-end print:hidden"
    />
  </div>
</template>

<script setup>
  import { computed } from 'vue'
  import { trans } from 'laravel-vue-i18n'
  import CopyTextButton from '@/components/Pages/Partials/CopyTextButton'

  const props = defineProps({
    commentary: { type: Object, required: true }
  })

  const citationTextLong = computed(() => {
    const date = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const dateString = date.toLocaleDateString(props.commentary.locale, options);
    const linkedDoi = props.commentary.doi ? `, DOI: <a target="blank" class="underline" href="https://doi.org/${props.commentary.doi}">${props.commentary.doi}</a>` : '';
    return `${props.commentary.suggested_citation_long} – ${trans('version')}: ${props.commentary.date}: ${window.location.href} (${trans('visited_at')} ${dateString})${linkedDoi}.`
  })

  const citationTextLongPrint = computed(() => {
    const date = new Date();
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    const dateString = date.toLocaleDateString(props.commentary.locale, options);
    const linkedDoi = props.commentary.doi ? `, DOI: https://doi.org/${props.commentary.doi}` : '';
    return `${props.commentary.suggested_citation_long} – ${trans('version')}: ${props.commentary.date}: ${window.location.href} (${trans('visited_at')} ${dateString})${linkedDoi}.`
  })

  const citationTextShort = computed(() => {
    return `${props.commentary.suggested_citation_short}: ${window.location.href}`
  })
</script>
