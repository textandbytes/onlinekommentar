
<template>
  <Head>
    <title>{{ __('home') }}</title>
  </Head>

  <div class="w-full md:w-1/2 px-8 md:px-0 mx-auto mb-auto mt-32">
    <p class="mt-8 text-5xl leading-tight">
        {{ __('home_text') }}
    </p>

    <Link
      :href="`/${$page.props.locale}/ueber-onlinekommentar`"
      class="ok-button">
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
