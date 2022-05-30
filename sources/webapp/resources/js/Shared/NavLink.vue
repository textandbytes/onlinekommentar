<template>
   <Link 
    class="text-ok-gray hover:underline" 
    :class="{ 'font-bold underline': active }" 
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