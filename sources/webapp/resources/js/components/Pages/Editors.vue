<template>
  <Users
    :title="title"
    :users="editors"
    :documents="documents"
    :active-document="activeDocument">
  </Users>
</template>

<script>
  import FrontendLayout from '@/Layouts/FrontendLayout.vue'
  
  export default {
    layout: FrontendLayout
  }
</script>

<script setup>
  import Users from '@/Pages/Frontend/Users'

  defineProps({
    title: { type: String, required: true },
    editors: { type: Object, required: true },
    documents: { type: Array, required: true },
    activeDocument: { type: String, required: true }
  })
</script>