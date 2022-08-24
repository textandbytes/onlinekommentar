
<template>
  <Head>
    <title>Startseite</title>
  </Head>

  <p class="mt-8 text-4xl leading-snug">
    Onlinekommentar.ch ist die erste gemeinnützige kostenlose Plattform für Open-Access-Kommentare in der Schweiz.
  </p>

  <Link
    :href="`/${$page.props.locale}/ueber-onlinekommentar`"
    class="inline-block mt-4 uppercase rounded-full border border-black text-xs px-4 py-2 font-medium tracking-widest">
    Mehr
  </Link>
</template>

<script>
  import FrontendLayout from '@/Layouts/FrontendLayout.vue'

  export default {
    layout: FrontendLayout
  }
</script>