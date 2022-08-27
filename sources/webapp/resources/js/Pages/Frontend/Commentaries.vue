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

    <CommentariesListView
      v-if="viewMode === 'list'"
      :commentary-groups="commentaryGroups"
      @selected="onSelected"
    />

    <CommentariesGridView
      v-else-if="viewMode === 'grid'"
      :commentaries="commentaries"
      @selected="onSelected"
    />
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
  import CommentariesListView from './Partials/CommentariesListView'
  import CommentariesGridView from './Partials/CommentariesGridView'
  import FlyoutMenuWithDividers from '@/Menus/FlyoutMenuWithDividers'

  const props = defineProps({
    commentaryGroups: { type: Object, required: true }
  })

  const locale = computed(() => usePage().props.value.locale)

  const viewMode = 'grid'

  const commentaries = computed(() => props.commentaryGroups.flat())

  const documents = [
    'Bundesverfassung (BV)',
    'Obligationenrecht (OR)',
    'Bundesgesetz über das Internationale Privatrecht (IPRG)',
    'Lugano-Übereinkommen (LugÜ)',
    'Strafprozessordnung',
  ]

  const activeDocument = 'Obligationenrecht (OR)'

  const onSelected = (commentary) => {
    Inertia.visit(route('Frontend/Commentary', {
      locale: locale.value,
      commentary: commentary
    }))
  }

  const onFilter = (document) => {
    console.log('filter commentaries by document:', document)
  }
</script>