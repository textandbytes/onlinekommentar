<template>
  <Head title="Dashboard" />

  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
    <h1 class="font-semibold text-2xl text-gray-800 leading-tight py-4 mb-8 border-b border-gray-200">
      Dashboard
    </h1>

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
      <Welcome />
    </div>
  </div>
</template>

<script setup>
  import Welcome from '@/Jetstream/Welcome.vue'
</script>