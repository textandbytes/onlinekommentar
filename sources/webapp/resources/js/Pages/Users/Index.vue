<template>
  <Head title="Manage Users" />

  <h1 class="font-semibold text-2xl text-gray-800 leading-tight py-4 mb-8 border-b border-gray-200">
    Users
  </h1>

  <div class="mt-8 flex flex-col">
    <div class="flex items-center justify-between mb-6">
      <input
        v-model="search"
        type="text"
        placeholder="Search..."
        size="40"
        class="border px-2 rounded-lg focus:ring-ok-blue-500"
      />

      <Link
        v-if="$page.props.can['create-users']"
        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-ok-blue text-base font-medium text--gray-900 hover:bg-ok-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-ok-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
        href="/cms/users/create">
        <span>Create</span>
        <span class="hidden md:inline">&nbsp;User</span>
      </Link>
    </div>

    <Pagination
      v-if="showPagination"
      :links="users.links"
      class="text-right my-6"
    />

    <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
          <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">
                  Name
                </th>

                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                  E-Mail
                </th>

                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                  Role
                </th>

                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm font-semibold text-gray-900">
                  <span class="sr-only">
                    Edit
                  </span>
                </th>

                <th v-if="$page.props.can['delete-users']" scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6 text-right text-sm font-semibold text-gray-900">
                  <span class="sr-only">
                    Delete
                  </span>
                </th>
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">
              <tr v-for="user in users.data" :key="user.email">
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                  <div class="flex items-center">
                    <div class="h-10 w-10 flex-shrink-0">
                      <img :src="user.profile_photo_url" :alt="user.name" class="rounded-full">
                    </div>
                    <div class="ml-4">
                      <div class="font-medium text-gray-900">
                        {{ user.name }}
                      </div>
                    </div>
                  </div>
                </td>

                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                  <div class="text-gray-500">
                    {{ user.email }}
                  </div>
                </td>

                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                  {{ user.role }}
                </td>

                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                  <Link :href="`/users/${user.id}/edit`" class="text-indigo-600 hover:text-indigo-900">
                    Edit<span class="sr-only">, {{ user.name }}</span>
                  </Link>
                </td>

                <td v-if="$page.props.can['delete-users']" class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                  <button
                    type="button"
                    @click.prevent="onDelete(user)"
                    class="text-red-600 hover:text-red-900 cursor-pointer">
                    Delete<span class="sr-only">, {{ user.name }}</span>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <Pagination
      v-if="showPagination"
      :links="users.links"
      class="text-right my-6"
    />
  </div>
</template>

<script setup>
  import { ref, computed, watch } from 'vue'
  import { Inertia } from '@inertiajs/inertia'
  import { Link } from '@inertiajs/inertia-vue3'
  import Pagination from '@/Shared/cms/Pagination'
  import debounce from 'lodash/debounce'
  import useEmitter from '../../composables/useEmitter'

  const emitter = useEmitter()

  const props = defineProps({
    users: { type: Object, required: true },
    filters: { type: Object, required: true }
  })

  const search = ref(props.filters.search)

  const showPagination = computed(() => props.users.last_page > 1)

  watch(search, debounce((value) => {
    Inertia.get('/cms/users', { search: value }, { preserveState: true, replace: true })
  }, 300))

  const onDelete = (user) => {
    let payload = {
      title: 'Delete User',
      message: 'Are you sure you want to delete user \'' + user.name + '\'?',
      confirmLabel: 'Delete',
      confirmCallback: () => {
        Inertia.post('/cms/users/' + user.id, { _method: 'DELETE' })
      }
    }
    emitter.emit('open-modal', payload)
  }
</script>