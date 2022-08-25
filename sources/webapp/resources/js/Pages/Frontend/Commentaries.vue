<template>
  <Head>
    <title>Kommentare</title>
  </Head>

  <div class="bg-gray-200 overflow-hidden shadow divide-y divide-gray-200 sm:divide-y-0 sm:grid sm:grid-cols-3 sm:gap-px">
    <div
      v-for="commentary in commentaries"
      :key="commentary.id"
      class="flex flex-col items-center relative group transition ease-in-out delay-150 bg-white hover:bg-ok-orange p-8 cursor-pointer"
      @click="onClick(commentary)">
      <div class="text-xs uppercase mb-8">
        Bundesverfassung
      </div>

      <div class="flex flex-col items-center">
        <h2 class="text-4xl font-medium mb-8">
          {{ commentary[`label_${$page.props.locale}`] }}
        </h2>

        <div class="text-sm text-center">
          Ein Kommentar von Marco Zollinger
        </div>

        <div class="mt-1 text-sm text-center">
          Herausgegeben von Stefan Schlegel und Odile Ammannn
        </div>
      </div>

      <button
        type="button"
        class="transition ease-in-out delay-150 inline-flex items-center px-3 py-1.5 border border-2 border-black text-xs font-medium uppercase rounded-full text-black bg-white group-hover:bg-black group-hover:text-white mt-12">
        Anzeigen
      </button>
    </div>
  </div>
</template>

<script>
  import FrontendLayout from '@/Layouts/FrontendLayout.vue'
  
  export default {
    layout: FrontendLayout
  }
</script>

<script setup>
  import { computed } from 'vue'
  import { Inertia } from '@inertiajs/inertia'
  import { usePage } from '@inertiajs/inertia-vue3'

  defineProps({
    commentaries: { type: Object, required: true }
  })

  const locale = computed(() => usePage().props.value.locale)

  const onClick = (commentary) => {
    Inertia.visit(route('Frontend/Commentary', {
      locale: locale.value,
      commentary: commentary
    }))
  }
</script>