<template>
  <SimpleMenu
    v-if="languages.length > 0"
    :options="languages"
    :active-option="activeLanguage"
    @changed="onChange"
  />
</template>

<script setup>
  // import { Inertia } from '@inertiajs/inertia'
  // import { usePage } from '@inertiajs/inertia-vue3'
  import SimpleMenu from '@/components/Menus/SimpleMenu.vue'

  const props = defineProps({
    languages: { type: Array, required: true },
    activeLanguage: { type: String, required: true }
  })

  const onChange = (language) => {
    // replace the locale segment in the url
    let targetUrl = window.location.href.replace(`/${props.activeLanguage}`, `/${language}`)

    // redirect to the language-specific version of the current page
    window.location.href = targetUrl
  }
</script>