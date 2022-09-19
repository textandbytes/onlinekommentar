<template>
  <Head>
    <title>{{ title }}</title>
  </Head>

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
          <img class="mr-2" src="/img/list.svg" alt="{{ __('list_view') }}"> {{ __('list_view') }}
        </button>

        <button
          type="button"
          :class="viewMode === 'grid' ? 'bg-ok-beige' : 'bg-white'"
          class="inline-flex items-center px-3 py-1 border border-ok-dark-gray shadow-sm text-xs uppercase leading-4 font-medium rounded-md text-black bg-white hover:bg-ok-light-beige focus:outline-none focus:ring-1 focus:ring-gray-300 tracking-wider">
          <img class="mr-2" src="/img/grid.svg" alt="{{ __('grid_view') }}"> {{ __('grid_view') }}
        </button>

        <FlyoutMenuWithDividers
          v-if="documents.length > 0"
          class="lg:min-w-[300px] lg:max-w-[300px] xl:min-w-[450px] xl:max-w-[450px] uppercase tracking-wider"
          :label="__('document_filter_label')"
          :options="documents"
          :active-option="activeDocument"
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
              {{ __('view_user') }}
            </button>
          </template>
        </UserCard>
      </template>
    </GridListView>
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
  import GridListView from './Partials/GridListView'
  import FlyoutMenuWithDividers from '@/Menus/FlyoutMenuWithDividers'
  import UserCard from './Partials/UserCard'

  defineProps({
    title: { type: String, required: true },
    users: { type: Object, required: true },
    documents: { type: Array, required: true },
    activeDocument: { type: String, required: true }
  })

  const locale = computed(() => usePage().props.value.locale)

  const viewMode = 'grid'

  const goToUserDetailView = (user) => {
    let userDetailComponent = usePage().component.value.slice(0, -1)
    Inertia.visit(route(userDetailComponent, {
      locale: locale.value,
      user: user
    }))
  }

  const onFilter = (document) => {}
</script>