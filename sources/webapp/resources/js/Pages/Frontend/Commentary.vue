<template>
  <Head>
    <title>Kommentar</title>
  </Head>

  <div class="md:max-w-6xl md:mx-auto md:mb-auto bg-white overflow-hidden px-4 md:px-24 md:py-12">
    <div class="relative flex justify-between items-center md:grid md:grid-cols-3 md:gap-px border-b-2 border-black">
      <FlyoutMenuFullWidth
        v-if="tableOfContents"
        label="Table of Contents"
        class="flex items-center py-2 md:py-4"
        :top-offset=14>
        <div v-html="tableOfContents" class="p-4"></div>
      </FlyoutMenuFullWidth>
      <div v-else class=" py-2 md:py-4">&nbsp;</div>

      <div class="md:flex items-center justify-center text-2xl font-serif hidden">
        {{ commentary.label_de }}
      </div>

      <FlyoutMenuFullWidth
        v-if="versions"
        label="Versions"
        class="flex items-center justify-end py-2 md:py-4"
        :top-offset=14>
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
        :top-offset=8
        class="relative flex justify-center w-full md:w-3/4 lg:w-1/2">
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

    <div class="my-8 space-y-6" v-html="content">
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
  import FlyoutMenuFullWidth from '@/Menus/FlyoutMenuFullWidth'
  import SuggestedCitationsPanel from '@/Pages/Frontend/Partials/SuggestedCitationsPanel'

  defineProps({
    document: { type: Object, required: true },
    commentary: { type: Object, required: true },
    content: { type: String, required: true },
    tableOfContents: { type: String, required: false, default: null },
    versions: { type: Object, required: false, default: null },
  })
</script>
