
<template>
  <article>
    <header class="flex justify-between py-4 px-8 lg:px-32">
      <div class="hidden md:flex z-40">
        <img src="/img/ok-logo-text.svg" alt="Onlinekommentar – der frei zugängliche Rechtskommenter" class="mt-4" />
      </div>
      
      <Nav />

      <Sidebar />
    </header>
    
    <main class="mt-8 p-6 mb-auto">
      <div class="max-w-3xl mx-auto">
        <slot />
      </div>
    </main>
  
   <Footer />

  </article>
  
</template>

<script setup>
import Nav from './Nav';
import Sidebar from './Sidebar';
import Footer from './Footer';

</script>

<style lang="postcss" scoped>
  article {
    min-height: 100%;
    display: grid;
    grid-template-rows: auto 1fr auto;
    grid-template-columns: 100%;
  }
  
</style>