
<template>
  <article>
    <header class="px-8 lg:px-32">
      <div
        class="flex items-start justify-between pt-8 pb-4 px-4"
        :class="{ 'border-b border-black': $page.component !== 'Frontend/Home' }">
        <div class="hidden md:flex z-40">
          <img
            src="/img/ok-logo-text.svg"
            alt="Onlinekommentar – der frei zugängliche Rechtskommenter"
            :width="$page.component !== 'Frontend/Home' ? 200 : null"
          />
        </div>
        
        <Nav />

        <Sidebar />
      </div>
    </header>
    
    <main class="max-w-7xl mx-auto mt-8 p-6 mb-auto">
      <slot />
    </main>
  
    <Footer />
  </article>
</template>

<script setup>
  import Nav from '@/Shared/Nav';
  import Sidebar from '@/Shared/Sidebar';
  import Footer from '@/Shared/Footer';
</script>

<style lang="postcss" scoped>
  article {
    min-height: 100%;
    display: grid;
    grid-template-rows: auto 1fr auto;
    grid-template-columns: 100%;
  }
</style>