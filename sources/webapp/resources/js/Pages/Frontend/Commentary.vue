<template>
  <Head>
    <title>Kommentar</title>
  </Head>

  <div class="max-w-6xl mx-auto mb-auto bg-white overflow-hidden px-24 py-12">
    <div class="sm:grid sm:grid-cols-3 sm:gap-px py-4 border-b-2 border-black">
      <div class="flex items-center text-xs uppercase">
        Table of Contents
      </div>

      <div class="flex items-center justify-center text-2xl font-serif">
        {{ commentary.label_de }}
      </div>

      <div class="flex items-center justify-end text-xs uppercase">
        Versions
      </div>
    </div>

    <div class="flex flex-col items-center my-12 space-y-6">
      <div class="text-xs font-sans uppercase">
        Kommentar Zu
      </div>

      <div class="text-6xl font-serif">
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

      <div class="text-xs uppercase">
        Zitiervorschlag
      </div>
    </div>

    <div class="flex flex-col p-8 bg-ok-orange space-y-6">
      <div class="font-bold font-serif">
        {{ document.label_de }}
      </div>

      <div v-html="document.content_de" class="space-y-6">
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
  defineProps({
    document: { type: Object, required: true },
    commentary: { type: Object, required: true },
    tableOfContents: { type: String, required: true },
    content: { type: String, required: true },
  })
</script>