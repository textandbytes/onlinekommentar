<template>
  <div class="flex flex-col">
    <div v-if="showHeaderLine" class="px-4 py-2 space-y-2 bg-white border-b border-black lg:flex lg:items-center lg:justify-between lg:space-y-0 md:px-6">
      <div class="text-xs font-medium tracking-wider uppercase">
        {{ $t('commentaries') }}
      </div>

      <div class="flex flex-col space-y-2 lg:flex-row lg:space-x-2 lg:space-y-0">
        <!-- <button
          type="button"
          :class="viewMode === 'list' ? 'bg-ok-beige' : 'bg-white'"
          class="inline-flex items-center px-3 py-1 text-xs font-medium leading-4 tracking-wider text-black uppercase bg-white border rounded-md shadow-sm border-ok-dark-gray hover:bg-ok-light-beige focus:outline-none focus:ring-1 focus:ring-gray-300"
          @click="">
          <img class="mr-2" src="/img/list.svg" alt="{{ $t('list_view') }}"> {{ $t('list_view') }}
        </button>

        <button
          type="button"
          :class="viewMode === 'grid' ? 'bg-ok-beige' : 'bg-white'"
          class="inline-flex items-center px-3 py-1 text-xs font-medium leading-4 tracking-wider text-black uppercase bg-white border rounded-md shadow-sm border-ok-dark-gray hover:bg-ok-light-beige focus:outline-none focus:ring-1 focus:ring-gray-300">
          <img class="mr-2" src="/img/grid.svg" alt="{{ $t('grid_view') }}"> {{ $t('grid_view') }}
        </button> -->

        <FlyoutMenuWithDividers
          v-if="legalDomains.length > 0"
          class="lg:min-w-[300px] lg:max-w-[300px] xl:min-w-[450px] xl:max-w-[450px] rounded-md uppercase tracking-wider"
          :label="$t('legal_domain_filter_label')"
          :options="legalDomains"
          :active-option="activeLegalDomain"
          @changed="onFilter"
        />
      </div>
    </div>

    <!-- <StackedListView
      v-if="viewMode === 'list'"
      directory="commentaryGroups">
      <template v-slot:item="commentary">
        <td class="flex flex-col py-3 text-gray-800 whitespace-nowrap">
          <div class="font-serif text-lg font-semibold">
            {{ commentary.label }}
          </div>
          <div class="text-sm text-gray-500 whitespace-normal md:hidden">
            Ein kommentar von <i>Marco Zollinger</i>
          </div>
          <div class="text-sm text-gray-500 whitespace-normal md:hidden">
            15.05.2021
          </div>
        </td>
        <td class="hidden py-3 md:flex">
          <div class="text-sm text-gray-500 whitespace-normal">
            Ein kommentar von <i>Marco Zollinger</i>
          </div>
        </td>
        <td class="hidden py-3 md:flex">
          <div class="text-sm text-gray-500 whitespace-normal">
            15.05.2021
          </div>
        </td>
        <td class="relative py-3 pl-3 text-sm font-medium text-right whitespace-nowrap">
          <button
            type="button"
            class="transition ease-in-out delay-150 inline-flex items-center px-3 py-1.5 border border-2 border-black text-xs font-medium uppercase rounded-full text-black bg-white group-hover:bg-black group-hover:text-white"
            @click="onSelect(commentary)">
            {{ $t('view_commentary') }}
          </button>
        </td>
      </template>
    </StackedListView> -->

    <GridListView
      :items="filteredCommentaries"
      class="sm:gap-px">
      <template v-slot:item="commentary">
        <a
          class="h-[310px] md:h-[340px] xl:h-[500px] relative group transition ease-in-out delay-150 bg-white hover:bg-ok-orange p-4 md:p-8 cursor-pointer"
          :href="'/' + locale + '/kommentare/' + commentary.slug">

          <div class="relative flex flex-col items-center w-full h-full">
            
            <div v-if="commentary.legal_domain" class="mb-8 text-xs tracking-wider text-center uppercase">
              {{ commentary.legal_domain.label }}
            </div>
            <div v-else class="mb-8 text-xs tracking-wider text-center uppercase">
              &nbsp;
            </div>
            
            <h2 class="my-4 font-serif text-3xl font-medium text-center lg:text-4xl 2xl:text-5xl lg:my-12">
              {{ commentary.title }}
            </h2>

            <div class="text-sm text-center lg:text-base">
              <p v-if="commentary.assigned_authors.length > 0 && commentary.assigned_authors[0] !== ''">
                {{ $t('commentary_by') }} <i>{{ commentary.assigned_authors.join(' ' + $t('and') + ' ') }}</i>
              </p>
              <p v-if="commentary.assigned_editors.length > 0 && commentary.assigned_editors[0] !== ''">
                {{ $t('edited_by') }} <i>{{ commentary.assigned_editors.join(' ' + $t('and') + ' ') }}</i>
              </p>
            </div>

            <div class="absolute bottom-0 flex w-full">
              <button
                type="button"
                class="pb-10 mx-auto ok-button">
                {{ $t('view_commentary') }}
              </button>
            </div>
          </div>
        </a>
      </template>
    </GridListView>
  </div>
</template>

<script setup>
  import { ref } from 'vue'
  import StackedListView from './Partials/StackedListView'
  import GridListView from './Partials/GridListView'
  import FlyoutMenuWithDividers from '@/components/Menus/FlyoutMenuWithDividers'

  const props = defineProps({
    locale: { type: String, required: true },
    commentaries: { type: Array, required: true },
    legalDomains: { type: Array, required: false, default: [] },
    showHeaderLine: { type: Boolean, required: false, default: true }
  })

  const viewMode = 'grid'

  const filteredCommentaries = ref(props.commentaries)

  const activeLegalDomain = ref(props.legalDomain ? props.legalDomains[0] : null)

  const onFilter = (legalDomain) => {
    // reset the list of filtered commentaries
    filteredCommentaries.value = props.commentaries

    if (legalDomain.id) {
      filteredCommentaries.value = filteredCommentaries.value.filter(commentary => {
        return commentary.legal_domain.id === legalDomain.id
      })
    }
  }
</script>

<style lang="postcss" scoped>
  h2 {
    @apply leading-snug;
  }
</style>