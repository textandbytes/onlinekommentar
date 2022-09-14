
<template>
  <Head>
    <title>{{ __('home') }}</title>
  </Head>

  <div class="max-w-3xl mx-auto mb-auto mt-8 p-6">
    <p class="mt-8 text-4xl leading-snug">
        {{ __('home_text') }}
    </p>

    <Link
      :href="`/${$page.props.locale}/ueber-onlinekommentar`"
      class="inline-block mt-4 uppercase rounded-full border border-black text-xs px-4 py-2 font-medium tracking-widest">
      {{ __('home_more_link') }}
    </Link>
  </div>
</template>

<script>
  import FrontendLayout from '@/Layouts/FrontendLayout.vue'

  export default {
    layout: FrontendLayout
  }
</script>
