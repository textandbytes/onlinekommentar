<template>
  <Head title="Manage Commentaries" />

  <div class="flex items-center justify-between pb-4 border-b">
    <h1 class="font-semibold text-2xl text-gray-800 leading-tight">
      Commentaries
    </h1>

    <Link
      v-if="$page.props.can['create-commentaries']"
      class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-ok-blue text-base font-medium text--gray-900 hover:bg-ok-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ok-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
      href="/cms/commentaries/create">
      <span>Create</span>
      <span class="hidden md:inline">&nbsp;Commentary</span>
    </Link>
  </div>

  <SelectableTableView
    :rows="commentaries"
    :columns="columns"
    :filters="filters"
    :editable="$page.props.can['edit-commentaries']"
    @on-search="onSearch"
    @on-select="onSelect">
    <template v-slot:row-data="commentary">
      <div v-if="columns.includes(commentary.property)" class="flex items-center px-6 py-4 text-sm text-gray-500">
        {{ commentary[commentary.property] }}
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
    commentaries: { type: Object, required: true },
    filters: { type: Object, required: true }
  })

  const columns = ['label_de', 'original_language', 'status']

  const onSearch = (query) => {
    Inertia.get('/cms/commentaries', { search: query }, { preserveState: true, replace: true })
  }

  const onSelect = (commentary) => {
    Inertia.get(`/cms/commentaries/${commentary.slug}/edit`)
  }
</script>