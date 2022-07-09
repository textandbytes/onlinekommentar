<template>
  <div id="sidebar" :class="{ 'open': isSidebarOpen }" class="z-50 absolute top-0 bottom-0 left-0 w-10 h-screen bg-ok-blue rounded-tr-xl rounded-br-xl">
  <div id="shadow" class="absolute top-0 bottom-0 left-0 w-2 h-screen bg-transparent"></div>
    
    <div v-if="isSidebarOpen" >
      <div class="block p-4">
        <img src="/img/ok-logo-text.svg" alt="Onlinekommentar – der frei zugängliche Rechtskommenter" class="w-48 mt-4" />
      </div>

       <div class="ml-4 mt-4">
        <tree :tree-data="treeData"></tree>
      </div>
    </div>
    
    <!-- sidebar handle -->
    <div @click="toggleSidebar" id="handle" class="absolute right-0 top-1/2 -mt-16 -mr-4 py-6 bg-ok-blue rounded-tr-lg rounded-br-lg shadow-tr-lg shadow-br-lg">
      <div id="handle-text" class="text-xs uppercase mb-6">Inhalt</div>
      <img class="ml-3" src="/img/sidebar-handle.svg" alt="Handle">
    </div>
    <!-- end sidebar handle -->

  </div>
</template>

<script setup>
  import { ref, onMounted } from 'vue'
  import Tree from "../Shared/Tree";

  const isSidebarOpen = ref(false)
  const treeData = ref({})
  
  const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value
  }

  onMounted(() => {
    // make an axios request to get the document tree
    axios.get('/tree')
      .then(response => {
        treeData.value = response.data
      })
      .catch(error => {
        console.log(error)
      })
  })

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
