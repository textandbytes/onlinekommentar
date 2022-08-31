<template>
  <div class="flex flex-wrap -mb-1">
    <template v-for="(link, key) in links">
      <div
        v-if="link.url === null"
        :key="key"
        class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 shadow ring-1 ring-black ring-opacity-5 rounded"
        v-html="link.label"
      />

      <Link
        v-else
        :key="`link-${key}`"
        class="mb-1 mr-1 px-4 py-3 focus:text-gray-500 text-sm leading-4 hover:bg-white shadow ring-1 ring-black ring-opacity-5 focus:border-gray-500 rounded"
        :class="{ 'bg-white': link.active }"
        :href="link.url"
        v-html="link.label"
      />
    </template>
  </div>
</template>

<script setup>
  defineProps({
    links: Array
  })
</script>