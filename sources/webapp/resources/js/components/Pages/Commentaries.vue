<template>
  <div class="flex flex-col">
    <div class="lg:flex lg:items-center lg:justify-between space-y-2 lg:space-y-0 px-4 py-2 md:px-6 border-b border-black bg-white">
      <div class="text-xs uppercase font-medium tracking-wider">
        {{ $t('commentaries') }}
      </div>

      <div class="flex flex-col lg:flex-row space-y-2 lg:space-x-2 lg:space-y-0">
        <button
          type="button"
          :class="viewMode === 'list' ? 'bg-ok-beige' : 'bg-white'"
          class="inline-flex items-center px-3 py-1 border border-ok-dark-gray shadow-sm text-xs uppercase leading-4 font-medium rounded-md text-black bg-white hover:bg-ok-light-beige focus:outline-none focus:ring-1 focus:ring-gray-300 tracking-wider"
          @click="">
          <img class="mr-2" src="/img/list.svg" alt="{{ $t('list_view') }}"> {{ $t('list_view') }}
        </button>

        <button
          type="button"
          :class="viewMode === 'grid' ? 'bg-ok-beige' : 'bg-white'"
          class="inline-flex items-center px-3 py-1 border border-ok-dark-gray shadow-sm text-xs uppercase leading-4 font-medium rounded-md text-black bg-white hover:bg-ok-light-beige focus:outline-none focus:ring-1 focus:ring-gray-300 tracking-wider">
          <img class="mr-2" src="/img/grid.svg" alt="{{ $t('grid_view') }}"> {{ $t('grid_view') }}
        </button>

        <FlyoutMenuWithDividers
          v-if="documents.length > 0"
          class="lg:min-w-[300px] lg:max-w-[300px] xl:min-w-[450px] xl:max-w-[450px] rounded-md uppercase tracking-wider"
          :label="$t('document_filter_label')"
          :options="documents"
          :active-option="activeDocument"
          @changed="onFilter"
        />
      </div>
    </div>

    <StackedListView
      v-if="viewMode === 'list'"
      :directory="commentaryGroups">
      <template v-slot:item="commentary">
        <td class="flex flex-col whitespace-nowrap py-3 text-gray-800">
          <div class="text-lg font-semibold font-serif">
            {{ commentary.label }}
          </div>
          <div class="whitespace-normal text-sm text-gray-500 md:hidden">
            Ein kommentar von <i>Marco Zollinger</i>
          </div>
          <div class="whitespace-normal text-sm text-gray-500 md:hidden">
            15.05.2021
          </div>
        </td>
        <td class="py-3 hidden md:flex">
          <div class="whitespace-normal text-sm text-gray-500">
            Ein kommentar von <i>Marco Zollinger</i>
          </div>
        </td>
        <td class="py-3 hidden md:flex">
          <div class="whitespace-normal text-sm text-gray-500">
            15.05.2021
          </div>
        </td>
        <td class="relative whitespace-nowrap py-3 pl-3 text-right text-sm font-medium">
          <button
            type="button"
            class="transition ease-in-out delay-150 inline-flex items-center px-3 py-1.5 border border-2 border-black text-xs font-medium uppercase rounded-full text-black bg-white group-hover:bg-black group-hover:text-white"
            @click="onSelect(commentary)">
            {{ $t('view_commentary') }}
          </button>
        </td>
      </template>
    </StackedListView>

    <GridListView
      v-else-if="viewMode === 'grid'"
      :items="commentaries"
      class="bg-gray-800 sm:gap-px">
      <template v-slot:item="commentary">
        <div
          class="h-[310px] md:h-[340px] xl:h-[500px] relative group transition ease-in-out delay-150 bg-white hover:bg-ok-orange p-8 cursor-pointer"
          @click="onSelect(commentary)">

          <div class="flex flex-col relative items-center h-full w-full">
            
            <div class="text-xs uppercase mb-8 tracking-wider">
              {{ commentary.document_label ?? '[UNKNOWN]' }}
            </div>
            
            <h2 class="text-5xl text-center font-medium font-serif my-12">
              {{ commentary.label }}
            </h2>

            <div class="text-sm text-center">
              Ein Kommentar von <i>Marco Zollinger</i>
            </div>

            <div class="text-sm text-center mt-1">
              Herausgegeben von <i>Stefan Schlegel</i> und <i>Odile Ammannn</i>
            </div>
            
            <div class="absolute flex bottom-0 w-full">
              <button
                type="button"
                class="ok-button mx-auto pb-10">
                {{ $t('view_commentary') }}
              </button>
            </div>

          </div>
        </div>
      </template>
    </GridListView>
  </div>
</template>

<script setup>
  import { computed } from 'vue'
  import StackedListView from './Partials/StackedListView'
  import GridListView from './Partials/GridListView'
  import FlyoutMenuWithDividers from '@/components/Menus/FlyoutMenuWithDividers'

  const props = defineProps({
    commentaryGroups: { type: Object, required: true }
  })

  const locale = computed(() => usePage().props.value.locale)

  const viewMode = 'grid'

  const commentaries = computed(() => Object.values(props.commentaryGroups).flat())

  const documents = [
    'Bundesverfassung',
    'Obligationenrecht',
    'Bundesgesetz über das Internationale Privatrecht',
    'Lugano-Übereinkommen',
    'Strafprozessordnung',
  ]

  const activeDocument = 'Obligationenrecht'

  const onSelect = (commentary) => {
    Inertia.visit(route('Frontend/Commentary', {
      locale: locale.value,
      commentary: commentary
    }))
  }

  const onFilter = (document) => {
    console.log('filter commentaries by document:', document)
  }
</script>