<template>
  <Head>
    <title>{{ title }}</title>
  </Head>

  <div class="flex flex-col">
    <div class="lg:flex lg:items-center lg:justify-between space-y-2 lg:space-y-0 p-4 md:px-6 border-b border-black bg-white">
      <div class="text-xs uppercase font-bold">
        {{ title }}
      </div>

      <div class="flex flex-col lg:flex-row space-y-2 lg:space-x-2 lg:space-y-0">
        <FlyoutMenuWithDividers
          v-if="documents.length > 0"
          class="lg:min-w-[300px] lg:max-w-[300px] xl:min-w-[450px] xl:max-w-[450px]"
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
              class="transition ease-in-out delay-150 inline-flex items-center px-3 py-1.5 border border-2 border-black text-xs font-medium uppercase rounded-full text-black bg-white group-hover:bg-black group-hover:text-white"
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

  const goToUserDetailView = (user) => {
    let userDetailComponent = usePage().component.value.slice(0, -1)
    Inertia.visit(route(userDetailComponent, {
      locale: locale.value,
      user: user
    }))
  }

  const onFilter = (document) => {}
</script>