<template>
  <div class="flex flex-col">
    <div class="lg:flex lg:items-center lg:justify-between space-y-2 lg:space-y-0 px-4 py-2 md:px-6 border-b border-black bg-white">
      <div class="text-xs uppercase font-medium tracking-wider">
        {{ title }}
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
          v-if="legalDomains.length > 0"
          class="lg:min-w-[300px] lg:max-w-[300px] xl:min-w-[450px] xl:max-w-[450px] uppercase tracking-wider"
          :label="$t('document_filter_label')"
          :options="legalDomains"
          :active-option="activeLegalDomain"
          @changed="onFilter"
        />
      </div>
    </div>

    <GridListView
      :items="users"
      class="bg-ok-beige sm:gap-x-px sm:gap-y-4">
      <template v-slot:item="user">
        <UserCard :user="user">
          <template v-slot:buttons>
            <button
              type="button"
              class="ok-button"
              @click="goToUserDetailView(user)">
              {{ $t('view_user') }}
            </button>
          </template>
        </UserCard>
      </template>
    </GridListView>
  </div>
</template>

<script setup>
  import { ref } from 'vue'
  import GridListView from './GridListView'
  import UserCard from './UserCard'
  import FlyoutMenuWithDividers from '@/components/Menus/FlyoutMenuWithDividers'

  const props = defineProps({
    title: { type: String, required: true },
    locale: { type: String, required: true },
    users: { type: Array, required: true },
    legalDomains: { type: Array, required: true }
  })

  const viewMode = 'grid'

  const activeLegalDomain = ref(props.legalDomains[0])

  const goToUserDetailView = (user) => {
    // TODO: implement
  }

  const onFilter = (document) => {}
</script>