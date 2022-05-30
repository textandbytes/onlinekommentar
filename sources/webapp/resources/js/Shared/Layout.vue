
<template>
  <section class="">
    <header class="flex justify-between">
      <div class="flex">
        <img src="/img/ok-logo.png" width="100" height="100" />
        <div class="flex flex-col uppercase m-5 leading-snug font-medium text-sm">
          <span class="flex flex-col">Onlinekommentar</span>
          <span class="flex flex-col">der frei zugängliche</span>
          <span class="flex flex-col">Rechtskommentar</span>
        </div>
      </div>
      
      <Nav />
    </header>
  </section>
  
  <section class="p-6 min-h-full">
    <div class="max-w-3xl mx-auto">
      <slot />
    </div>
  </section>
  
</template>

<script setup>
import Nav from './Nav';

</script>

<style scoped>
 
</style>