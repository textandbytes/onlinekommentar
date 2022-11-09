<template>
  <Users
    :locale="locale"
    :title="$t('editors')"
    :users="editors"
    :legal-domains="legalDomains"
    :base-path-prefix="'/' + locale + '/herausgeber'">
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