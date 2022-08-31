<template>
  <div class="bg-gray-800 overflow-hidden shadow divide-y divide-gray-800 sm:divide-y-0 sm:grid sm:grid-cols-3 sm:gap-px">
    <div
      v-for="item in items"
      :key="item.id"
      class="flex flex-col items-center relative group transition ease-in-out delay-150 bg-white hover:bg-ok-orange p-8 cursor-pointer"
      @click="$emit('selected', item)">
      <slot name="item" v-bind="item" />
    </div>

    <div v-for="n in (items.length % 3) + 1" class="bg-white" />
  </div>
</template>

<script setup>
  defineProps({
    items: { type: Object, required: true }
  })
</script>