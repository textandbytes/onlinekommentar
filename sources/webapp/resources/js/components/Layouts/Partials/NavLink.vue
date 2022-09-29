<template>
   <a 
    class="text-black hover:text-gray-600"
    :class="{ 'font-semibold': active }">
    <slot></slot>
  </a>
</template>

<script setup>
  defineProps({
    active: Boolean
  })
</script>