<template>
  <Users
    :locale="locale"  
    :title="$t('authors')"
    :users="authors"
    :legal-domains="legalDomains"
    :base-path-prefix="'/' + locale + '/autoren'">
  </Users>
</template>

<script setup>
  import Users from '@/components/Pages/Partials/Users'

  defineProps({
    locale: { type: String, required: true },
    authors: { type: Array, required: true },
    legalDomains: { type: Array, required: true }
  })
</script>