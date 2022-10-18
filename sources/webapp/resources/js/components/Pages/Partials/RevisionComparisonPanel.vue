<template>
  <div class="prose max-w-full" v-html="content"></div>
</template>

<script setup>
  defineProps({
    content: { type: String, required: true }
  })
</script>

<style lang="postcss" scoped>
  :deep(del) {
    @apply bg-[#e77276]
  }

  :deep(ins) {
    @apply bg-[#79ee75]
  }

  :deep(.diff-wrapper.diff th) {
    @apply px-0 py-2
  }

  :deep(.diff-wrapper.diff td) {
    @apply p-0
  }
</style>