<template>
  <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <h1 class="font-semibold text-2xl text-gray-800 leading-tight py-4 mb-8 border-b border-gray-200">
      API Tokens
    </h1>

    <ApiTokenManager
      :tokens="tokens"
      :available-permissions="availablePermissions"
      :default-permissions="defaultPermissions"
    />
  </div>
</template>

<script setup>
  import ApiTokenManager from '@/Pages/API/Partials/ApiTokenManager.vue'

  defineProps({
      tokens: Array,
      availablePermissions: Array,
      defaultPermissions: Array,
  })
</script>