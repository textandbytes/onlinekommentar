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

  <div
    v-if="commentaries.data.length > 0 || search !== undefined"
    class="flex flex-col mt-6">
    <div class="flex items-end justify-between mb-6">
      <input
        v-model="search"
        type="text"
        placeholder="Search..."
        size="40"
        class="border px-2 rounded-lg focus:ring-ok-blue-500"
      />

      <Pagination
        v-if="showPagination"
        :links="commentaries.links"
        class="text-right"
      />
    </div>

    <div
      v-if="commentaries.data.length > 0"
      class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
          <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                  Content
                </th>

                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                  Original Language
                </th>

                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">
                  Status
                </th>

                <th v-if="$page.props.can['edit-commentaries']" scope="col" class="relative px-4 py-3.5 text-right text-sm font-semibold text-gray-900">
                  <span class="sr-only">
                    Edit
                  </span>
                </th>

                <th v-if="$page.props.can['delete-commentaries']" scope="col" class="relative px-4 py-3.5 sm:pr-6 text-right text-sm font-semibold text-gray-900">
                  <span class="sr-only">
                    Delete
                  </span>
                </th>
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">
              <tr v-for="commentary in commentaries.data" :key="commentary.email">
                <td
                  class="px-4 py-3.5 text-sm text-gray-500"
                  v-html="commentary.content_de">
                </td>

                <td class="whitespace-nowrap px-4 py-3.5 text-sm text-gray-500">
                  {{ __(commentary.original_language) }}
                </td>

                <td class="whitespace-nowrap px-4 py-3.5 text-sm text-gray-500">
                  {{ __(commentary.status) }}
                </td>

                <td v-if="$page.props.can['edit-commentaries']" class="relative whitespace-nowrap px-4 py-3.5 text-right text-sm font-medium">
                  <Link :href="`/cms/commentaries/${commentary.id}/edit`" class="text-indigo-600 hover:text-indigo-900">
                    Edit<span class="sr-only">, {{ commentary.id }}</span>
                  </Link>
                </td>

                <td v-if="$page.props.can['delete-commentaries']" class="relative whitespace-nowrap px-4 py-3.5 text-right text-sm font-medium sm:pr-6">
                  <button
                    type="button"
                    @click.prevent="onDelete(commentary)"
                    class="text-red-600 hover:text-red-900 cursor-pointer">
                    Delete<span class="sr-only">, {{ commentary.id }}</span>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div v-else>
      No commentaries found.
    </div>

    <Pagination
      v-if="showPagination"
      :links="commentaries.links"
      class="text-right my-6"
    />
  </div>
  <div v-else class="mt-6">
    No commentaries exist.
  </div>
</template>

<script>
  import CmsLayout from '@/Layouts/CmsLayout.vue'
  
  export default {
    layout: CmsLayout
  }
</script>

<script setup>
  import { ref, computed, watch } from 'vue'
  import { Inertia } from '@inertiajs/inertia'
  import { Link } from '@inertiajs/inertia-vue3'
  import Pagination from '@/Shared/cms/Pagination'
  import debounce from 'lodash/debounce'
  import useEmitter from '../../composables/useEmitter'

  const emitter = useEmitter()

  const props = defineProps({
    commentaries: { type: Object, required: true },
    filters: { type: Object, required: true }
  })

  const search = ref(props.filters.search)

  const showPagination = computed(() => props.commentaries.last_page > 1)

  watch(search, debounce((value) => {
    Inertia.get('/cms/commentaries', { search: value }, { preserveState: true, replace: true })
  }, 300))

  const onDelete = (commentary) => {
    let payload = {
      title: 'Delete Commentary',
      message: 'Are you sure you want to delete this commentary?',
      confirmLabel: 'Delete',
      confirmCallback: () => {
        Inertia.post('/cms/commentaries/' + commentary.id, { _method: 'DELETE' })
      }
    }
    emitter.emit('open-modal', payload)
  }
</script>