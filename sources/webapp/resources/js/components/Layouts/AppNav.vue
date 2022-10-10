<template>
  <Transition>
    <div v-show="showMenu" class="absolute top-0 left-0 w-screen h-screen bg-ok-yellow z-10">
      <nav class="flex h-screen justify-center md:justify-end items-center text-right mr-4 lg:mr-32 text-3xl">
        <ul class="flex flex-col list-style-none space-y-5">
          <NavLink
            :href="'/' + locale + '/kommentare'"
            :active="false"
            @click="toggleMenu">
            {{ $t('commentaries') }}
          </NavLink>

          <NavLink
            :href="'/' + locale + '/autoren'"
            :active="false"
            @click="toggleMenu">
            {{ $t('authors') }}
          </NavLink>

          <NavLink
            :href="'/' + locale + '/herausgeber'"
            :active="false"
            @click="toggleMenu">
            {{ $t('editors') }}
          </NavLink>

          <NavLink
            :href="'/' + locale + '/ueber-onlinekommentar'"
            :active="false"
            @click="toggleMenu">
            {{ $t('about') }}
          </NavLink>

          <NavLink
            :href="'/' + locale + '/contact'"
            :active="false"
            @click="toggleMenu">
            {{ $t('contact') }}
          </NavLink>
        </ul>
      </nav>
    </div>
  </Transition>

  <nav>
    <ul class="flex items-center space-x-6">
      <li id="nav-search" class="cursor-pointer">
        <div class="flex">
          <input ref="searchInput" v-show="searchBox" type="search" :placeholder="$t('nav_search_box_placeholder')" class="w-48 md:w-64 xl:w-96 bg-white border-b-2 border-t-0 border-l-0 border-r-0 border-black focus:border-b-2 focus:border-black focus:ring-0 placeholder:text-xs md:placeholder:text-base xl:placeholder:text-lg">

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

      <LanguageSelector
        id="nav-lang-switcher"
        as="li"
        :languages="locales"
        :active-language="locale"
      />

      <li id="nav-menu" @click="toggleMenu" class="z-50">
        <button type="button" class="w-32 uppercase rounded-full border border-black text-xs font-medium tracking-wider py-3 text-center inline-flex items-center justify-center mr-2 mb-2">
          {{ $t('menu') }}
          <svg v-show="showMenu" class="ml-2" xmlns="http://www.w3.org/2000/svg" width="14.707" height="14.707" viewBox="0 0 14.707 14.707">
            <g id="X" transform="translate(-1792.387 -75.877)">
              <g id="Gruppe_17" data-name="Gruppe 17" transform="translate(1792.741 90.231) rotate(-45)">
                <line id="Linie_2" data-name="Linie 2" x2="19.799" fill="none" stroke="#000" stroke-width="1"/>
              </g>
              <g id="Gruppe_18" data-name="Gruppe 18" transform="translate(1806.741 90.231) rotate(-135)">
                <line id="Linie_2-2" data-name="Linie 2" x2="19.799" transform="translate(0 0)" fill="none" stroke="#000" stroke-width="1"/>
              </g>
            </g>
          </svg>
        </button>
      </li>
    </ul>
  </nav>
</template>

<script setup>
  import { ref } from 'vue'
  import NavLink from './Partials/NavLink.vue'
  import LanguageSelector from './Partials/LanguageSelector.vue'

  defineProps({
    locale: { type: String, required: true },
    locales: { type: Array, required: true }
  })

  const searchBox = ref(false)
  const searchInput = ref()
  const showMenu = ref(false)

  const toggleMenu = () => {
    showMenu.value = !showMenu.value
  }

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
  .v-enter-active,
  .v-leave-active {
    transition: opacity 0.5s ease;
  }

  .v-enter-from,
  .v-leave-to {
    opacity: 0;
  }
</style>