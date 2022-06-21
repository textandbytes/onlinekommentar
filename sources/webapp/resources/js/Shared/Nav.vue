<template>
  <nav>
    <ul class="flex mt-4 space-x-6">
          
      <li id="nav-search" class="cursor-pointer">
          <div class="flex">
            <input ref="searchInput" v-show="searchBox" type="search" placeholder="Suchbegriff eingeben" class="w-48 md:w-64 xl:w-96 bg-white border-b-2 border-t-0 border-l-0 border-r-0 border-black focus:border-b-2 focus:border-black focus:ring-0 placeholder:text-xs md:placeholder:text-base xl:placeholder:text-lg">
        
            <span @click="toggleSearchBox" :class="{ 'bg-white border-b-2 border-black' : searchBox }">
              <svg id="Search" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 45 45">
                <g id="Icon_feather-search" data-name="Icon feather-search" transform="translate(6.759 7.129)" style="isolation: isolate">
                  <path id="Pfad_13" data-name="Pfad 13" d="M23.826,14.163A9.663,9.663,0,1,1,14.163,4.5a9.663,9.663,0,0,1,9.663,9.663Z" transform="translate(0 0)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                  <path id="Pfad_14" data-name="Pfad 14" d="M30.229,30.229l-5.254-5.254" transform="translate(-3.988 -3.988)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/>
                </g>
                <rect id="Rechteck_24" data-name="Rechteck 24" width="45" height="45" fill="none"/>
              </svg>
            </span>
          </div>
      </li>

      <li id="nav-lang-switcher">
          <Menu as="div" class="relative inline-block text-left">
            <div class="border-black border-b">
              <MenuButton class="inline-flex border-b justify-center w-full rounded-md py-1 bg-transparent text-xs font-medium text-gray-700 focus:outline-none">
                DE
                <ChevronDownIcon class="-mr-1 ml-2 h-5 w-5" aria-hidden="true" />
              </MenuButton>
            </div>

            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
              <MenuItems class="origin-top-right absolute right-0 mt-2 w-12 rounded-sm shadow-xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
                <div class="py-1">
                  <MenuItem v-slot="{ active }">
                    <a href="#" :class="[active ? 'bg-ok-beige text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-xs']">DE</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a href="#" :class="[active ? 'bg-ok-beige text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-xs']">EN</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a href="#" :class="[active ? 'bg-ok-beige text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-xs']">FR</a>
                  </MenuItem>
                  <MenuItem v-slot="{ active }">
                    <a href="#" :class="[active ? 'bg-ok-beige text-gray-900' : 'text-gray-700', 'block px-4 py-2 text-xs']">IT</a>
                  </MenuItem>
                </div>
              </MenuItems>
            </transition>
          </Menu>
      </li>

      <li id="nav-menu" @click="toggleMenu">
        <button class="uppercase rounded-full border border-black text-xs px-8 py-2 font-medium tracking-wider">Menu</button>
      </li>

    </ul>
  </nav>
</template>

<script setup>
import { Menu, MenuButton, MenuItem, MenuItems } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/solid'
import { ref } from 'vue'

  const searchBox = ref(false)
  const searchInput = ref()

  const toggleSearchBox = () => {
    searchBox.value = !searchBox.value
    if (searchBox.value) {
      setTimeout(() => {
        searchInput.value.focus()
      }, 100)
    }
  }

</script>

<style lang="postcss" scoped>

</style>