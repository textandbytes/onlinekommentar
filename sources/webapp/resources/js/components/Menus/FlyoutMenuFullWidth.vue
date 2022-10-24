<template>
  <Popover v-slot="{ open }">
    <PopoverButton :class="[open ? 'text-gray-900' : 'text-gray-800', 'group inline-flex items-center bg-white text-base font-medium hover:text-gray-900 focus:outline-none']">
      <span class="text-xs tracking-widest uppercase">
        {{ label }}
      </span>

      <ChevronDownIcon
        class="w-5 h-5 ml-1 text-gray-800"
        :class="[open ? 'rotate-180' : 'rotate-0']"
        aria-hidden="true"
      />
    </PopoverButton>

    <transition enter-active-class="transition duration-200 ease-out" enter-from-class="translate-y-1 opacity-0" enter-to-class="translate-y-0 opacity-100" leave-active-class="transition duration-150 ease-in" leave-from-class="translate-y-0 opacity-100" leave-to-class="translate-y-1 opacity-0">
      <PopoverPanel class="absolute inset-x-0 z-10 bg-white shadow-md" :class="menuClasses">
        <div class="p-4 overflow-hidden drop-shadow-2xl ring-1 ring-black ring-opacity-5 print:block print:drop-shadow-none print:ring-none print:overflow-auto">
          <slot />
        </div>
      </PopoverPanel>
    </transition>
  </Popover>
</template>

<script setup>
  import { Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'
  import { ChevronDownIcon } from '@heroicons/vue/solid'

  defineProps({
    label: { type: String, required: true },
    menuClasses: { type: String, required: false, default: null }
  })
</script>

<style lang="postcss" scoped>
  .rotate-0 {
    transform: rotate(0deg);
    transition: all .3s ease-in-out;
  }

  .rotate-180 {
    transform: rotate(-180deg);
    transition: all .3s ease-in-out;
  }
</style>
