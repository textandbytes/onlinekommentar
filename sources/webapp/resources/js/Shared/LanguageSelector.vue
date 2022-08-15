<template>
  <SimpleMenu
    :options="languages"
  />
</template>

<script setup>
  import SimpleMenu from '../Menus/SimpleMenu.vue'

  defineProps({
    languages: { type: Array, required: true }
  })
</script>