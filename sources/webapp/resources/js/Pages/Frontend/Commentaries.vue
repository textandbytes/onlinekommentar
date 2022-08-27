<template>
  <Head>
    <title>{{ __('commentaries') }}</title>
  </Head>

  <div class="flex flex-col">
    <div class="flex items-center justify-between px-4 py-2 border-b border-black bg-white">
      <div class="text-xs uppercase font-bold">
        {{ __('commentaries') }}
      </div>

      <div class="flex space-x-2">
        <button
          type="button"
          class="inline-flex items-center px-3 py-1 border border-ok-dark-gray shadow-sm text-xs uppercase leading-4 font-medium rounded-sm text-black bg-white hover:bg-ok-light-beige focus:outline-none focus:ring-1"
          @click="">
          <i class="ph-list text-lg -ml-0.5 mr-1"></i> {{ __('list_view') }}
        </button>

        <button
          type="button"
          class="inline-flex items-center px-3 py-1 border border-ok-dark-gray shadow-sm text-xs uppercase leading-4 font-medium rounded-sm text-black bg-white hover:bg-ok-light-beige focus:outline-none focus:ring-1">
          <i class="ph-grid-four text-lg -ml-0.5 mr-1"></i> {{ __('grid_view') }}
        </button>

        <FlyoutMenuWithDividers
          v-if="documents.length > 0"
          class="min-w-[450px] max-w-[450px]"
          :label="__('document_filter_label')"
          :options="documents"
          :active-option="activeDocument"
          @changed="onFilter"
        />
      </div>
    </div>

    <div class="bg-gray-800 overflow-hidden shadow divide-y divide-gray-800 sm:divide-y-0 sm:grid sm:grid-cols-3 sm:gap-px">
      <div
        v-for="commentary in commentaries"
        :key="commentary.id"
        class="flex flex-col items-center relative group transition ease-in-out delay-150 bg-white hover:bg-ok-orange p-8 cursor-pointer"
        @click="onClick(commentary)">
        <div class="text-xs uppercase mb-8">
          Bundesverfassung
        </div>

        <div class="flex flex-col items-center">
          <h2 class="text-4xl text-center font-medium font-serif mb-8">
            {{ commentary[`label_${$page.props.locale}`] }}
          </h2>

          <div class="text-sm text-center">
            Ein Kommentar von <i>Marco Zollinger</i>
          </div>

          <div class="text-sm text-center mt-1">
            Herausgegeben von <i>Stefan Schlegel</i> und <i>Odile Ammannn</i>
          </div>
        </div>

        <button
          type="button"
          class="transition ease-in-out delay-150 inline-flex items-center px-3 py-1.5 border border-2 border-black text-xs font-medium uppercase rounded-full text-black bg-white group-hover:bg-black group-hover:text-white mt-12">
          {{ __('view_commentary') }}
        </button>
      </div>

      <div v-for="n in (commentaries.length % 3) + 1" class="bg-white" />
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
  import FlyoutMenuWithDividers from '@/Menus/FlyoutMenuWithDividers'

  const props = defineProps({
    commentaryGroups: { type: Object, required: true }
  })

  const locale = computed(() => usePage().props.value.locale)

  const commentaries = computed(() => props.commentaryGroups.flat())

  const documents = [
    'Bundesverfassung (BV)',
    'Obligationenrecht (OR)',
    'Bundesgesetz über das Internationale Privatrecht (IPRG)',
    'Lugano-Übereinkommen (LugÜ)',
    'Strafprozessordnung',
  ]

  const activeDocument = 'Obligationenrecht (OR)'

  const onClick = (commentary) => {
    Inertia.visit(route('Frontend/Commentary', {
      locale: locale.value,
      commentary: commentary
    }))
  }

  const onFilter = (document) => {
    console.log('filter commentaries by document:', document)
  }
</script>