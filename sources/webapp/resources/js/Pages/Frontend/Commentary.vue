<template>
  <Head>
    <title>Kommentar</title>
  </Head>

  <div class="md:max-w-6xl md:mx-auto md:mb-auto bg-white overflow-hidden px-4 md:px-24 md:py-12">
    <div class="relative flex justify-between items-center md:grid md:grid-cols-3 md:gap-px border-b border-black">
      <FlyoutMenuFullWidth
        v-if="tableOfContents"
        :label="tocLabel"
        class="flex items-center py-2 md:py-4"
        menu-classes="top-16">
        <div v-html="tableOfContents" class="toc p-4"></div>
      </FlyoutMenuFullWidth>
      <div v-else class=" py-2 md:py-4">&nbsp;</div>

      <div class="md:flex items-center justify-center text-2xl font-serif hidden">
        {{ commentary.label_de }}
      </div>

      <FlyoutMenuFullWidth
        v-if="versions"
        label="Versions"
        class="flex items-center justify-end py-2 md:py-4"
        menu-classes="top-16">
      </FlyoutMenuFullWidth>
      <div v-else class=" py-2 md:py-4">&nbsp;</div>
    </div>

    <div class="flex flex-col items-center my-8 md:my-12 space-y-6">
      <div class="text-xs font-sans uppercase">
        {{ __('commentary_on') }}
      </div>

      <div class="text-2xl md:text-6xl font-serif">
        {{ commentary.label_de }}
      </div>

      <div class="text-center">
        <p>
          Ein Kommentar von <i>Marco Zollinger</i>
        </p>
        <p>
          Herausgegeben von <i>Stefan Schlegel</i> und <i>Odile Ammannn</i>
        </p>
      </div>

      <FlyoutMenuFullWidth
        v-if="commentary"
        label="Zitiervorschlag"
        class="relative flex justify-center w-full md:w-2/3"
        menu-classes="top-8">
        <SuggestedCitationsPanel :commentary="commentary" />
      </FlyoutMenuFullWidth>
    </div>

    <div class="flex flex-col p-4 md:p-8 bg-ok-orange space-y-4 md:space-y-6">
      <div class="font-bold font-serif">
        {{ document.label_de }}
      </div>

      <div v-html="document.content_de" class="space-y-4 md:space-y-6">
      </div>
    </div>

    <div class="content my-8" v-html="content">
    </div>
  </div>
</template>

<script>
  import FrontendLayout from '@/Layouts/FrontendLayout'

  export default {
    layout: FrontendLayout
  }
</script>

<script setup>
  import { computed } from 'vue'
  import { usePage } from '@inertiajs/inertia-vue3'
  import FlyoutMenuFullWidth from '@/Menus/FlyoutMenuFullWidth'
  import SuggestedCitationsPanel from '@/Pages/Frontend/Partials/SuggestedCitationsPanel'

  const translations = computed(() => usePage().props.value.translations)
  const tocLabel = translations.value.table_of_contents

  defineProps({
    document: { type: Object, required: true },
    commentary: { type: Object, required: true },
    content: { type: String, required: true },
    tableOfContents: { type: String, required: false, default: null },
    versions: { type: Object, required: false, default: null },
  })
</script>

<style lang="postcss" scoped>
  .content {
    :deep(h2) {
      @apply uppercase font-sans tracking-wider text-xl mt-12 mb-6
    }

    :deep(h3) {
      @apply font-sans tracking-wider text-xl mt-12 mb-6
    }

    :deep(h4) {
      @apply font-sans tracking-wider text-lg mb-6
    }

    :deep(p) {
      @apply relative font-serif mb-6
    }
    :deep(.paragraph-nr) {
      @apply absolute -left-8 text-sm font-sans
    }
  }

  .toc {
    :deep(ul > li) {
      @apply uppercase
    }

    :deep(ul li ul li) {
      @apply ml-4 normal-case
    }
  }
  


</style>