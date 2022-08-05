<template>
  <AppLayout title="Manage Users">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Users</h2>
    </template>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="mt-8 flex flex-col">
        <input
          v-model="search"
          type="text"
          placeholder="Search name, e-mail or role..."
          class="border px-2 rounded-lg"
        />

        <div class="my-6">
          <Pagination
            v-if="showPagination"
            :links="users.links"
            class="text-right"
          />
        </div>

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

                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                      <span class="sr-only">
                        Edit
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
                      <a href="#" class="text-indigo-600 hover:text-indigo-900">
                        Edit<span class="sr-only">, {{ user.name }}</span>
                      </a>
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
    </div>
  </AppLayout>
</template>

<script setup>
  import AppLayout from '@/Layouts/AppLayout.vue'
  import Pagination from '@/Shared/cms/Pagination'
  import { ref, watch } from 'vue'
  import { Inertia } from '@inertiajs/inertia'
  import debounce from 'lodash/debounce'
  import { computed } from 'vue'

  const props = defineProps({
    users: { type: Object, required: true },
    filters: { type: Object, required: true }
  })

  const search = ref(props.filters.search)

  const showPagination = computed(() => props.users.last_page > 1)

  watch(search, debounce((value) => {
    Inertia.get('/cms/users', { search: value }, { preserveState: true, replace: true })
  }, 300))
</script>

