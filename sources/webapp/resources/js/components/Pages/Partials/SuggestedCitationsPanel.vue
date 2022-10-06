<template>
  <div class="text-xs text-gray-800 space-y-4">
    <div>
      {{ citationTextLong }}
    </div>

    <CopyTextButton
      :label="$t('copy_citation')"
      :text="citationTextLong"
      class="flex items-center justify-end"
    />

    <div class="border-t border-black pt-2">
      {{ $t('short_citation') }}: {{ commentary.suggested_citation_short }}
    </div>

    <CopyTextButton
      :label="$t('copy_citation')"
      :text="citationTextShort"
      class="flex items-center justify-end"
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
    const current = new Date()
    const date = `${current.getDate()}/${current.getMonth()+1}/${current.getFullYear()}`
    return `${props.commentary.suggested_citation_long}: ${window.location.href} (${trans('visited_at')} ${date})`
  })

  const citationTextShort = computed(() => {
    return `${props.commentary.suggested_citation_short}: ${window.location.href}`
  })
</script>