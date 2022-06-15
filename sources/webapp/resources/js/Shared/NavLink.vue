<template>
   <Link 
    class="text-black hover:text-gray-600"
    :class="{ 'font-semibold': active }" 
  >
    <slot></slot>
  </Link>
</template>

<script setup>
  import { Link } from '@inertiajs/inertia-vue3';

  defineProps({
      active: Boolean
  });

</script>

<style lang="scss" scoped>

</style>