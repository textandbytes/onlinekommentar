<template>
  <div id="sidebar" :class="{ 'open': isSidebarOpen }" class="fixed top-0 bottom-0 z-50 w-6 h-screen lg:w-12 lg:left-0 -left-4 md:left-0 bg-ok-blue rounded-tr-xl rounded-br-xl">
    <div id="shadow" class="absolute top-0 bottom-0 left-0 hidden w-2 h-screen bg-transparent lg:block">
    </div>
    
    <div v-if="isSidebarOpen" class="h-screen overflow-y-auto">
      <div class="block p-4">
        <img src="/img/ok-logo-text.svg" alt="Onlinekommentar – der frei zugängliche Rechtskommenter" class="w-48 mt-4" />
      </div>

      <div class="mt-4 ml-4">
        <slot name="content" />
      </div>
    </div>
    
    <!-- sidebar handle -->
    <div @click="toggleSidebar" id="handle" class="absolute right-0 py-6 -mt-24 -mr-5 rounded-tr-lg rounded-br-lg md:py-10 md:-mr-4 top-1/2 bg-ok-blue shadow-tr-lg shadow-br-lg">
      <div class="flex flex-col items-center mt-6 w-7 md:w-10 lg:w-12">
        <div id="handle-text" class="mb-6 text-xs font-medium tracking-wider uppercase">
          {{ $t('sidebar_handle_text') }}
        </div>
        <img class="w-4 mt-6 md:w-6" src="/img/sidebar-handle.svg" alt="Handle">
      </div>
    </div>
    <!-- end sidebar handle -->
  </div>
</template>

<script setup>
  import { ref } from 'vue'

  const isSidebarOpen = ref(false)
  
  const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value
  }
</script>

<style lang="postcss" scoped>
  #shadow {
    box-shadow: inset 10px 0 10px -10px rgba(0, 0, 0, 0.4);
  }

  #sidebar {
    box-shadow: 5px 0 10px -3px rgba(0, 0, 0, 0.1);
    transition: width .3s;

    &.open {
      width: 680px;
      max-width: 95%;
      transition: width .3s;
    }
  }

  #handle {
    cursor: pointer;

    #handle-text {
      transform: rotate(-90deg);
    }  
  }
</style>