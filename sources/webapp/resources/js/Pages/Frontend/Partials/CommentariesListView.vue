<template>
  <div class="bg-white overflow-hidden shadow mb-12 pt-3 pb-8">
    <template v-for="group in commentaryGroups">
      <div class="my-8 sm:px-6 lg:px-8">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full align-middle md:px-6">
            <table class="min-w-full divide-y divide-gray-300 border-b">
              <thead>
                <tr>
                  <th scope="col" class="py-2 pl-4 pr-3 text-left text-sm uppercase font-semibold text-gray-500 sm:pl-6 md:pl-0" colspan="4">
                    Bundesverfassung
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <tr
                  v-for="commentary in group"
                  :key="commentary.id"
                  @click="$emit('selected', commentary)">
                  <td class="whitespace-nowrap p-3 text-lg font-semibold font-serif text-gray-800 sm:pl-6 md:pl-0">
                    {{ commentary.label }}
                  </td>
                  <td class="whitespace-nowrap p-3 text-sm text-gray-500">
                    Ein kommentar von <i>Marco Zollinger</i>
                  </td>
                  <td class="whitespace-nowrap p-3 text-sm text-gray-500">
                    15.05.2021
                  </td>
                  <td class="relative whitespace-nowrap p-3 text-right text-sm font-medium sm:pr-6 md:pr-0">
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