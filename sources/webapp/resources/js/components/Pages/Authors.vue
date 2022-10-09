<template>
  <Users
    :title="$t('authors')"
    :locale="locale"
    :users="authors"
    :legal-domains="legalDomains">
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