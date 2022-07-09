<template>
  <div id="sidebar" :class="{ 'open': isSidebarOpen }" class="z-50 absolute top-0 bottom-0 left-0 w-10 h-screen bg-ok-blue rounded-tr-xl rounded-br-xl">
  <div id="shadow" class="absolute top-0 bottom-0 left-0 w-2 h-screen bg-transparent"></div>
    
    <!-- sidebar handle -->
    <div @click="toggleSidebar" id="handle" class="absolute right-0 top-1/2 -mt-16 -mr-4 py-6 bg-ok-blue rounded-tr-lg rounded-br-lg shadow-tr-lg shadow-br-lg">
      <div id="handle-text" class="text-xs uppercase mb-6">Inhalt</div>
      <img class="ml-3" src="/img/sidebar-handle.svg" alt="Handle">
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

<style lang="postcss" scope>
  #shadow {
    box-shadow: inset 5px 0 5px -5px rgba(0, 0, 0, 0.8);
  }
  #sidebar {
    box-shadow: 5px 0 10px -3px rgba(0, 0, 0, 0.1);
    transition: width .3s;

    &.open {
      width: 450px;
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
