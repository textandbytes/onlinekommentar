<template>
  <Users
    :title="$t('editors')"
    :locale="locale"
    :users="editors"
    :legal-domains="legalDomains">
  </Users>
</template>

<script setup>
  import Users from '@/components/Pages/Partials/Users'

  defineProps({
    locale: { type: String, required: true },
    editors: { type: Array, required: true },
    legalDomains: { type: Array, required: true }
  })
</script>