<template>
  <div id="sidebar" :class="{ 'open': isSidebarOpen }" class="z-50 fixed top-0 bottom-0 -left-4 md:left-0 w-10 h-screen bg-ok-blue rounded-tr-xl rounded-br-xl">
    <div id="shadow" class="absolute top-0 bottom-0 left-0 w-2 h-screen bg-transparent">
    </div>
    
    <div v-if="isSidebarOpen" class="overflow-y-auto h-screen">
      <div class="block p-4">
        <img src="/img/ok-logo-text.svg" alt="Onlinekommentar – der frei zugängliche Rechtskommenter" class="w-48 mt-4" />
      </div>

      <div class="ml-4 mt-4">
        <slot name="content" />
      </div>
    </div>
    
    <!-- sidebar handle -->
    <div @click="toggleSidebar" id="handle" class="absolute right-0 top-1/2 -mt-24 -mr-4 py-10 bg-ok-blue rounded-tr-lg rounded-br-lg shadow-tr-lg shadow-br-lg">
      <div class="flex flex-col items-center mt-6 w-12">
        <div id="handle-text" class="text-xs tracking-wider uppercase mb-6 font-medium">
          [TRANSLATE sidebar_handle_text]
        </div>
        <img class="mt-6" src="/img/sidebar-handle.svg" height="22" width="24" alt="Handle">
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
    box-shadow: inset 5px 0 5px -5px rgba(0, 0, 0, 0.8);
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