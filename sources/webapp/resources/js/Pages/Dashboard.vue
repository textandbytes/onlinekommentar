<template>
  <Head title="Dashboard" />

  <h1 class="font-semibold text-2xl text-gray-800 leading-tight py-4 mb-8 border-b border-gray-200">
    Dashboard
  </h1>

  <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
    <Welcome />
  </div>
</template>

<script>
  import CmsLayout from '@/Layouts/CmsLayout.vue'
  
  export default {
    layout: CmsLayout
  }
</script>

<script setup>
  import Welcome from '@/Jetstream/Welcome.vue'
</script>