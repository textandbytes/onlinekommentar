<template>
  <header class="px-8 lg:px-32">
    <div class="flex items-start justify-between pt-8 pb-4 px-4">
      <a
        href="/en"
        class="hidden md:flex z-40">
        <img
          src="/img/ok-logo-text.svg"
          alt="Onlinekommentar - der frei zugängliche Rechtskommenter"
          width="200"
        />
      </a>

      <AppNav />

      <AppSidebar />
    </div>
  </header>
</template>

<script setup>
  import AppNav from './AppNav.vue'
  import AppSidebar from './AppSidebar.vue'

  // defineProps({
  //   locales: { type: Array, required: true },
  //   activeLocale: { type: String, required: true }
  // })

  // TODO: onMounted => send notification to language switcher
</script>