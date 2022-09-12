<template>
  <Head>
    <title>Über uns</title>
  </Head>

  <div class="max-w-3xl mx-auto mb-auto mt-8 p-6">
    <h1 class="text-2xl py-4 font-serif">
      {{ __('about') }}
    </h1>

    <div class="text-lg prose" v-html="__('about_text')">
    </div>
  </div>
</template>

<script>
  import FrontendLayout from '@/Layouts/FrontendLayout.vue'

  export default {
    layout: FrontendLayout
  }
</script>
