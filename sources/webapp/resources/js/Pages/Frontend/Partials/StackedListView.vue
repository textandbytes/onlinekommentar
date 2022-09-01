<template>
  <div class="bg-white overflow-hidden mb-12 pb-8">
    <template v-for="(group, label) in directory">
      <div class="my-2 sm:px-6 lg:px-6">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full align-middle px-4 md:px-6 md:py-4 lg:px-8">
            <table class="min-w-full divide-y divide-gray-300 border-b">
              <thead>
                <tr>
                  <th scope="col" class="py-2 pr-3 text-left text-sm uppercase font-semibold text-gray-500" colspan="4">
                    {{ label !== '' ? label : '[UNKNOWN]' }}
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <tr
                  v-for="item in group"
                  :key="item.id"
                  @click="$emit('selected', item)"
                  class="flex items-center justify-between">
                  <slot name="item" v-bind="item" />
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
    directory: { type: Object, required: true }
  })
</script>