<template>
  <div class="bg-white overflow-hidden shadow mb-12 pb-8">
    <template v-for="group in commentaryGroups">
      <div class="my-2 sm:px-6 lg:px-6">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full align-middle px-4 lg:px-6">
            <table class="min-w-full divide-y divide-gray-300 border-b">
              <thead>
                <tr>
                  <th scope="col" class="py-2 pr-3 text-left text-sm uppercase font-semibold text-gray-500" colspan="4">
                    Bundesverfassung
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <tr
                  v-for="commentary in group"
                  :key="commentary.id"
                  @click="$emit('selected', commentary)"
                  class="flex items-center justify-between">
                  <td class="flex flex-col whitespace-nowrap py-3 text-gray-800">
                    <div class="text-lg font-semibold font-serif">
                      {{ commentary.label }}
                    </div>
                    <div class="whitespace-normal text-sm text-gray-500 md:hidden">
                      Ein kommentar von <i>Marco Zollinger</i>
                    </div>
                    <div class="whitespace-normal text-sm text-gray-500 md:hidden">
                      15.05.2021
                    </div>
                  </td>
                  <td class="py-3 hidden md:flex">
                    <div class="whitespace-normal text-sm text-gray-500">
                      Ein kommentar von <i>Marco Zollinger</i>
                    </div>
                  </td>
                  <td class="py-3 hidden md:flex">
                    <div class="whitespace-normal text-sm text-gray-500">
                      15.05.2021
                    </div>
                  </td>
                  <td class="relative whitespace-nowrap py-3 pl-3 text-right text-sm font-medium">
                    <button
                      type="button"
                      class="transition ease-in-out delay-150 inline-flex items-center px-3 py-1.5 border border-2 border-black text-xs font-medium uppercase rounded-full text-black bg-white group-hover:bg-black group-hover:text-white">
                      {{ __('view_commentary') }}
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </template>
  </div>
</template>

<script setup>
  defineProps({
    commentaryGroups: { type: Object, required: true }
  })
</script>