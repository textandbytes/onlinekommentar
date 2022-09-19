<template>
  <div class="overflow-hidden divide-y divide-gray-800 sm:divide-y-0 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
    <template
      v-for="item in items"
      :key="item.id">
      <slot name="item" v-bind="item" />
    </template>

    <div v-for="n in (items.length % 3) + 1" class="bg-white" />
  </div>
</template>

<script setup>
  defineProps({
    items: { type: Object, required: true }
  })
</script>