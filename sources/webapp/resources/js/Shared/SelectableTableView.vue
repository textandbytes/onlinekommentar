<template>
  <div
    v-if="rows.data.length > 0 || search !== undefined"
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
        :links="rows.links"
        class="text-right"
      />
    </div>

    <div 
      v-if="rows.data.length > 0"
      class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
          <table class="min-w-full divide-y divide-gray-300">
            <thead class="bg-gray-50">
              <tr class="text-left text-sm font-semibold text-gray-900">
                <th v-for="column in columns" scope="col" class="py-4 px-6">
                  {{ __(column) }}
                </th>
                <th v-if="editable"></th>
              </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">
              <tr
                v-for="row in rows.data"
                :key="row.id"
                :class="{ 'hover:bg-gray-100 cursor-pointer': editable }"
                @click="editable ? { click: $emit('on-select', row) } : {}">
                <td v-for="column in columns" :key="column">
                  <slot name="row-data" v-bind="row" :property="column"></slot>
                </td>
                <td v-if="editable">
                  <ChevronRightIcon class="block w-6 h-6 fill-gray-400" aria-hidden="true" />
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div v-else>
      No results found.
    </div>

    <Pagination
      v-if="showPagination"
      :links="rows.links"
      class="text-right my-6"
    />
  </div>
  <div v-else class="mt-6">
    No results exist.
  </div>
</template>

<script setup>
  import { ref, computed, watch } from 'vue'
  import Pagination from '@/Shared/cms/Pagination'
  import debounce from 'lodash/debounce'
  import { ChevronRightIcon } from '@heroicons/vue/solid'

  const props = defineProps({
    rows: { type: Object, required: true },
    columns: { type: Array, required: true },
    filters: { type: Object, required: true },
    editable: { type: Boolean, required: false, default: false },
  })

  emits: ['on-search', 'on-select']

  const search = ref(props.filters.search)

  const showPagination = computed(() => props.rows.last_page > 1)

  watch(search, debounce((value) => {
    this.$emit('on-search', value)
  }, 300))
</script>