<template>
  <div class="md:max-w-6xl md:mx-auto md:mb-auto bg-white overflow-hidden px-4 md:px-24 md:py-12">
    <div class="relative flex justify-between items-center py-4 border-b-2 border-black">
      <a
        class="inline-flex items-center py-1 text-xs uppercase leading-4 font-medium rounded-sm text-black bg-white focus:outline-none focus:ring-2 focus:ring-gray-300"
        :href="basePathPrefix">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-3 h-3 mr-2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
        </svg>
        {{ $t('back_to_results') }}
      </a>
    </div>

    <div class="w-full md:w-2/3 lg:w-1/2 2xl:w-1/3 m-auto flex flex-col items-center my-8 md:my-12 space-y-6">
      <UserCard
        :locale="locale"
        :user="user"
      />
    </div>
  </div>

</template>

<script setup>
  import UserCard from './Partials/UserCard'

  defineProps({
    locale: { type: String, required: true },
    user: { type: Object, required: true },
    basePathPrefix: { type: String, required: true }
  })
</script>