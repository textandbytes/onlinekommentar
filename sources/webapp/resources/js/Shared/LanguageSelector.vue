<template>
  <SimpleMenu
    v-if="languages.length > 0"
    :options="languages"
    :active-option="activeLanguage"
    @changed="onChange"
  />
</template>

<script setup>
  import { Inertia } from '@inertiajs/inertia'
  import SimpleMenu from '@/Menus/SimpleMenu'

  defineProps({
    languages: { type: Array, required: true },
    activeLanguage: { type: String, required: true }
  })

  const onChange = (language) => {
    /*
     * Reload the current page component with the selected language 
     * to update the locale segment in the url and to load the 
     * corresponding translations.
     */
    Inertia.visit(route(Inertia.page.component, language))
  }
</script>