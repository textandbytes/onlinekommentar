<template>
  <div class="overflow-hidden divide-y divide-gray-800 sm:divide-y-0 sm:grid sm:grid-cols-3">
    <template
      v-for="item in items"
      :key="item.id"
      @click="$emit('selected', item)">
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