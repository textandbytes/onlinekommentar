<template>
  <Head>
    <title>{{ title }}</title>
  </Head>

  <div class="md:max-w-6xl md:mx-auto md:mb-auto bg-white overflow-hidden px-4 md:px-24 md:py-12">
    <div class="relative flex justify-between items-center py-4 border-b-2 border-black">
      <button
        type="button"
        class="inline-flex items-center py-1 text-xs uppercase leading-4 font-medium rounded-sm text-black bg-white focus:outline-none focus:ring-2 focus:ring-gray-300"
        @click="goToParentComponent">
        <i class="ph-caret-left text-lg -ml-0.5 mr-1"></i> {{ __('back_to_results') }}
      </button>
    </div>

    <div class="flex flex-col items-center my-8 md:my-12 space-y-6">
      <UserCard :user="user" />
    </div>
  </div>

</template>

<script>
  import FrontendLayout from '@/Layouts/FrontendLayout.vue'
  
  export default {
    layout: FrontendLayout
  }
</script>

<script setup>
  import { computed } from 'vue'
  import { Inertia } from '@inertiajs/inertia'
  import { usePage } from '@inertiajs/inertia-vue3'
  import UserCard from './Partials/UserCard'

  const props = defineProps({
    title: { type: String, required: true },
    user: { type: Object, required: true },
    parentComponent: { type: String, required: true }
  })

  const locale = computed(() => usePage().props.value.locale)

  const goToParentComponent = () => {
    Inertia.visit(route(props.parentComponent, {
      locale: locale.value
    }))
  }
</script>