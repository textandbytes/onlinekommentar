<template>
  <div id="sidebar" :class="{ 'open': isSidebarOpen }" class="z-50 absolute top-0 bottom-0 left-0 w-10 h-screen bg-ok-blue rounded-tr-xl rounded-br-xl">
  <div id="shadow" class="absolute top-0 bottom-0 left-0 w-2 h-screen bg-transparent"></div>
    
    <!-- sidebar handle -->
    <div @click="toggleSidebar" id="handle" class="absolute right-0 top-1/2 -mr-4 py-6 bg-ok-blue rounded-tr-lg rounded-br-lg shadow-tr-lg shadow-br-lg">
      <div id="handle-text" class="text-xs uppercase mb-6">Inhalt</div>
      <svg class="ml-3" xmlns="http://www.w3.org/2000/svg" width="18" height="16.2" viewBox="0 0 24.75 22.25">
        <g id="Icon_ionic-md-list" data-name="Icon ionic-md-list" transform="translate(-5.625 -6.188)">
          <path id="Pfad_8" data-name="Pfad 8" d="M5.625,26.438h24.75v2H5.625Z"/>
          <path id="Pfad_5" data-name="Pfad 5" d="M5.625,19.688h18v2h-18Z" transform="translate(6.75)"/>
          <path id="Pfad_6" data-name="Pfad 6" d="M5.625,12.938h22.5v2H5.625Z" transform="translate(2.25)"/>
          <path id="Pfad_7" data-name="Pfad 7" d="M5.625,6.188h24.75v2H5.625Z"/>
        </g>
      </svg>
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
