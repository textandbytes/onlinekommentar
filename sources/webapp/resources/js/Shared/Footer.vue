<template>
   <footer class="bg-ok-yellow flex mt-8">
    <div class="left-top border-r border-ok-dark-gray">
      
      <div class="pt-2 pl-12 border-b border-r border-ok-dark-gray">
        <NavLink 
          href="/commentaries"
          :active="$page.component === 'Commentaries'"
        >
          Kommentare
        </NavLink>
      </div>
      
      <div class="pt-2 pl-4 border-b border-ok-dark-gray">
        <NavLink 
          href="/"
          :active="$page.component === 'Home'" 
        >
          Home
        </NavLink>
      </div>
      
      <div class="pt-2 pl-12 border-b border-r border-ok-dark-gray">
         <NavLink 
          href="/authors"
          :active="$page.component === 'Authors'"
        >
          Autor:innen
        </NavLink>
      </div>
      
      <div class="pt-2 pl-4 border-b border-ok-dark-gray">
         <NavLink 
          href="/about"
          :active="$page.component === 'About'" 
        >
          Über uns
        </NavLink>
      </div>
      
      <div class="pt-2 pl-12 border-b border-r border-ok-dark-gray">
         <NavLink 
          href="/editors"
          :active="$page.component === 'Editors'" 
        >
          Herausgeber:innen
        </NavLink>
      </div>
      
      <div class="pt-2 pl-4 border-b border-ok-dark-gray">
        <NavLink 
          href="/contact"
          :active="$page.component === 'Contact'" 
        >
          Kontakt
        </NavLink>
      </div>

    </div>
    
    <div class="border-b border-ok-dark-gray pt-4">
      <div class="px-8 pb-4">
        <div class="text-sm w-1/2">Haben Sie Fragen zum Konzept oder möchten Sie einen Kommentar für den Onlinekommentar verfassen?</div>
        <button class="mt-2 px-8 py-1 text-center uppercase text-xs rounded-full border border-ok-dark-gray">
          <a href="/contact">Kontaktieren Sie uns</a>
        </button>
      </div>
  
    </div>
    
    <div class="flex justify-between border-r border-ok-dark-gray">
      <div class="flex flex-col pl-12 pt-4">
        <span class="text-xs">&copy; {{ new Date().getFullYear() }}, Onlinekommentar.ch</span>
      </div>

      <div class="flex flex-row pt-2 mr-4 space-x-2">
        <a class="flex flex-col external" href="https://www.linkedin.com/company/onlinekommentar/" target="_blank">
          <span class="inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 32 32">
              <path id="Icon_awesome-linkedin" data-name="Icon awesome-linkedin" d="M29.714,2.25H2.279A2.3,2.3,0,0,0,0,4.557V31.943A2.3,2.3,0,0,0,2.279,34.25H29.714A2.3,2.3,0,0,0,32,31.943V4.557A2.3,2.3,0,0,0,29.714,2.25ZM9.671,29.679H4.929V14.407h4.75V29.679ZM7.3,12.321a2.75,2.75,0,1,1,2.75-2.75,2.751,2.751,0,0,1-2.75,2.75ZM27.45,29.679H22.707V22.25c0-1.771-.036-4.05-2.464-4.05-2.471,0-2.85,1.929-2.85,3.921v7.557H12.65V14.407H17.2v2.086h.064a5,5,0,0,1,4.493-2.464c4.8,0,5.693,3.164,5.693,7.279Z" transform="translate(0 -2.25)"/>
            </svg>
          </span>
        </a>
        <a class="flex flex-col external" href="https://twitter.com/O_Kommentar" target="blank">
          <span class="inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 32 32">
              <path id="Icon_awesome-twitter-square" data-name="Icon awesome-twitter-square" d="M28.571,2.25H3.429A3.429,3.429,0,0,0,0,5.679V30.821A3.429,3.429,0,0,0,3.429,34.25H28.571A3.429,3.429,0,0,0,32,30.821V5.679A3.429,3.429,0,0,0,28.571,2.25ZM25.079,13.593c.014.2.014.407.014.607A13.238,13.238,0,0,1,11.764,27.529a13.267,13.267,0,0,1-7.193-2.1,9.869,9.869,0,0,0,1.129.057,9.392,9.392,0,0,0,5.814-2,4.691,4.691,0,0,1-4.379-3.25A5.049,5.049,0,0,0,9.25,20.15a4.685,4.685,0,0,1-3.75-4.6v-.057a4.682,4.682,0,0,0,2.114.593,4.675,4.675,0,0,1-2.086-3.9,4.626,4.626,0,0,1,.636-2.364,13.3,13.3,0,0,0,9.657,4.9,4.695,4.695,0,0,1,7.993-4.279,9.18,9.18,0,0,0,2.971-1.129,4.672,4.672,0,0,1-2.057,2.579,9.323,9.323,0,0,0,2.7-.729A9.861,9.861,0,0,1,25.079,13.593Z" transform="translate(0 -2.25)"/>
            </svg>
          </span>
        </a>
      </div>
    </div>
  
    <div>
      <div class="flex flex-row justify-between px-8 pt-4">
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
  
        <button class="w-20 text-center text-sm rounded-full border border-ok-dark-gray">
          <!-- arrow up -->
          <a href="#top" class="text-black font-semibold top-link">
            ↑
          </a>
        </button>
      </div>
    </div>

  </footer>
</template>

<style lang="postcss" scoped>
  footer {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: 3fr 2fr;
    grid-column-gap: 0px;
    grid-row-gap: 0px;
  }

  .left-top {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-template-rows: 1fr 1fr 1fr;
    grid-column-gap: 0px;
    grid-row-gap: 0px;
  }
  

</style>