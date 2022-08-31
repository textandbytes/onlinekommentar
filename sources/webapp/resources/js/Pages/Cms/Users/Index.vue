<template>
  <Head title="Manage Users" />

  <div class="flex items-center justify-between pb-4 border-b">
    <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
      Users
    </h1>

    <Link
      v-if="$page.props.can['create-users']"
      class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-ok-blue text-base font-medium text--gray-900 hover:bg-ok-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ok-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
      href="/cms/users/create">
      <span>Create</span>
      <span class="hidden md:inline">&nbsp;User</span>
    </Link>
  </div>

  <SelectableTableView
    :rows="users"
    :columns="columns"
    :filters="filters"
    :editable="$page.props.can['edit-users']"
    @on-search="onSearch"
    @on-select="onSelect">
    <template v-slot:row-data="user">
      <div v-if="user.property === 'name'" class="flex items-center px-6 py-4 focus:text-indigo-500">
        <!-- profile photo and name-->
        <div class="h-10 w-10 flex-shrink-0">
          <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full">
        </div>
        <div class="ml-4 font-medium text-sm text-gray-900">
          {{ user.name }}
        </div>
      </div>

      <div v-else-if="columns.includes(user.property)" class="flex items-center px-6 py-4 text-sm text-gray-500">
        {{ user[user.property] }}
      </div>
    </template>
  </SelectableTableView>
</template>

<script>
  import CmsLayout from '@/Layouts/CmsLayout.vue'
  
  export default {
    layout: CmsLayout
  }
</script>

<script setup>
  import { Inertia } from '@inertiajs/inertia'
  import { Link } from '@inertiajs/inertia-vue3'
  import SelectableTableView from '@/Shared/SelectableTableView'

  defineProps({
    users: { type: Object, required: true },
    filters: { type: Object, required: true }
  })

  const columns = ['name', 'email', 'title', 'role']

  const onSearch = (query) => {
    Inertia.get('/cms/users', { search: query }, { preserveState: true, replace: true })
  }

  const onSelect = (user) => {
    Inertia.get(`/cms/users/${user.id}/edit`)
  }
</script>