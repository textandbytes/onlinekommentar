
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
            Autor:innen
          </NavLink>

          <NavLink 
            href="/editors"
            :active="$page.component === 'Editors'" 
          >
            Herausgeber:innen
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
              <span class="inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                  <path id="Icon_awesome-linkedin" data-name="Icon awesome-linkedin" d="M29.714,2.25H2.279A2.3,2.3,0,0,0,0,4.557V31.943A2.3,2.3,0,0,0,2.279,34.25H29.714A2.3,2.3,0,0,0,32,31.943V4.557A2.3,2.3,0,0,0,29.714,2.25ZM9.671,29.679H4.929V14.407h4.75V29.679ZM7.3,12.321a2.75,2.75,0,1,1,2.75-2.75,2.751,2.751,0,0,1-2.75,2.75ZM27.45,29.679H22.707V22.25c0-1.771-.036-4.05-2.464-4.05-2.471,0-2.85,1.929-2.85,3.921v7.557H12.65V14.407H17.2v2.086h.064a5,5,0,0,1,4.493-2.464c4.8,0,5.693,3.164,5.693,7.279Z" transform="translate(0 -2.25)"/>
                </svg>
              </span>
            </a>
            <a class="external" href="https://twitter.com/O_Kommentar" target="blank">
              <span class="inline-block">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                  <path id="Icon_awesome-twitter-square" data-name="Icon awesome-twitter-square" d="M28.571,2.25H3.429A3.429,3.429,0,0,0,0,5.679V30.821A3.429,3.429,0,0,0,3.429,34.25H28.571A3.429,3.429,0,0,0,32,30.821V5.679A3.429,3.429,0,0,0,28.571,2.25ZM25.079,13.593c.014.2.014.407.014.607A13.238,13.238,0,0,1,11.764,27.529a13.267,13.267,0,0,1-7.193-2.1,9.869,9.869,0,0,0,1.129.057,9.392,9.392,0,0,0,5.814-2,4.691,4.691,0,0,1-4.379-3.25A5.049,5.049,0,0,0,9.25,20.15a4.685,4.685,0,0,1-3.75-4.6v-.057a4.682,4.682,0,0,0,2.114.593,4.675,4.675,0,0,1-2.086-3.9,4.626,4.626,0,0,1,.636-2.364,13.3,13.3,0,0,0,9.657,4.9,4.695,4.695,0,0,1,7.993-4.279,9.18,9.18,0,0,0,2.971-1.129,4.672,4.672,0,0,1-2.057,2.579,9.323,9.323,0,0,0,2.7-.729A9.861,9.861,0,0,1,25.079,13.593Z" transform="translate(0 -2.25)"/>
                </svg>
              </span>
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