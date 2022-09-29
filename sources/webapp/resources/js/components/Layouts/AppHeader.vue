<template>
  <header class="px-8 lg:px-16 xl:px-32 w-full xl:w-10/12 mx-auto">
    <div
      class="flex items-start justify-between pt-8 pb-4 px-4"
      :class="{ 'border-b border-black': false }">
      <a
        class="hidden md:flex z-40"
        :href="`/{{ locale }}`">
        <img
          src="/img/ok-logo-text.svg"
          alt="Onlinekommentar – der frei zugängliche Rechtskommenter"
          :width="false ? 200 : null"
        />
      </a>

      <AppNav
        :locale="locale"
        :locales="locales">
      </AppNav>

      <AppSidebar>
        <template v-slot:content>
          <slot name="sidebar-content" />
        </template>
      </AppSidebar>
    </div>
  </header>
</template>

<script setup>
  import AppNav from './AppNav.vue'
  import AppSidebar from './AppSidebar.vue'

  defineProps({
    locale: { type: String, required: true },
    locales: { type: Array, required: true }
  })
</script>