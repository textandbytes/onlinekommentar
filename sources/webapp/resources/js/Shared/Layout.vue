
<template>
  <section class="px-32">
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
  
  <section class="p-6 mb-auto">
    <div class="max-w-3xl mx-auto">
      <slot />
    </div>
  </section>

  <section>
    <footer class="bg-ok-yellow flex mt-8">
      <!-- Main: left section -->
      <div class="w-1/2 border-r border-black flex">
        
        <!-- Left: left Section -->
        <div class="w-1/2 flex flex-col">
          <NavLink 
            href="/commentaries"
            :active="$page.component === 'Commentaries'"
          >
            Kommentare
          </NavLink>

          <NavLink 
            href="/authors"
            :active="$page.component === 'Authors'"
          >
            Autorinnen und Autoren
          </NavLink>

          <NavLink 
            href="/editors"
            :active="$page.component === 'Editors'" 
          >
            Herausgeberinnen und Herausgeber
          </NavLink>

          <div class="py-2 pl-12 mb-4">
            <span class="text-xs">&copy; {{ new Date().getFullYear() }}, Onlinekommentar.ch</span>
          </div>
        </div>
      
        <!-- Left: right section -->
        <div class="w-1/2 flex flex-col left-section-right">
           <NavLink 
            href="/"
            :active="$page.component === 'Home'" 
          >
            Home
          </NavLink>

          <NavLink 
            href="/about"
            :active="$page.component === 'About'" 
          >
            Über uns
          </NavLink>

          <NavLink 
            href="/contact"
            :active="$page.component === 'Contact'" 
          >
            Kontakt
          </NavLink>

          <div class="text-right py-2 mb-4 mr-4">
            <a class="external" href="https://www.linkedin.com/company/onlinekommentar/" target="_blank">
              <span class="inline-block w-6 h-6 bg-black cursor-pointer hover:bg-gray-600 text-white text-center px-1 font-bold rounded">in</span>
            </a>
            <a class="external" href="https://twitter.com/O_Kommentar" target="blank">
              <span class="inline-block w-6 h-6 bg-black cursor-pointer hover:bg-gray-600 text-white text-center px-1 font-bold rounded">t</span>
            </a>
          </div>
        </div>

      </div>
      
      <!-- Main: right Section -->
      <div class="w-1/2 py-4 right-section">
        <div class="flex w-3/4 flex-col px-8">
          <div class="text-sm">Haben Sie Fragen zum Konzept oder möchten Sie einen Kommentar für den Onlinekommentar verfassen?</div>
          <div class="mt-4 w-60 text-center uppercase text-xs rounded-full border border-black py-2 px-4">
            <a href="/contact">Kontaktieren Sie uns</a>
          </div>
        </div>
        
        <div class="flex flex-row justify-between mt-4 border-t border-black pt-4 px-8">
          <div class="flex text-xs space-x-8">
             <NavLink 
              href="/disclaimer"
              :active="$page.component === 'Disclaimer'" 
            >
              Haftungsauschluss
            </NavLink>
  
             <NavLink 
              href="/imprint"
              :active="$page.component === 'Imprint'" 
            >
              Impressum
            </NavLink>
  
          </div>
  
          <div class="w-24 text-center text-sm rounded-full border border-black">
            <!-- arrow up -->
            <a href="#top" class="text-black top-link">
              ↑
            </a>
          </div>
        </div>

      </div>
    </footer>
  </section>
  
</template>

<script setup>
import Nav from './Nav';

</script>

<style lang="postcss" scoped>
  a {
    @apply border-b border-r border-black py-2 pl-12;

    &.external {
      @apply border-none p-0 mr-2;
    }

    &.top-link {
      @apply px-8 !important;
    }
  }

  .left-section-right {
    a {
      @apply border-r-0;
    }
  }

  .right-section {
    a {
      @apply border-none p-0;
    }
  }
  
</style>