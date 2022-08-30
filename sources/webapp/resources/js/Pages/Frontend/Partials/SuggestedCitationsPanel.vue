<template>
  <div class="text-xs font-semibold text-gray-800 space-y-4">
    <div>
      {{ commentary.suggested_citation_long }}
    </div>

    <div>
      {{ commentary.suggested_citation_short }}
    </div>

    <CopyTextButton
      :label="__('copy_citation')"
      :text="citationText"
      class="flex items-center justify-end"
    />
  </div>
</template>

<script setup>
  import { computed } from 'vue'
  import CopyTextButton from '@/Pages/Frontend/Partials/CopyTextButton'

  const props = defineProps({
    commentary: { type: Object, required: true }
  })

  const citationText = computed(() => {
    return `${props.commentary.suggested_citation_short}: ${window.location.href}`
  })
</script>