<template>
  <Popover v-slot="{ open }">
    <PopoverButton :class="[open ? 'text-gray-900' : 'text-gray-800', 'group inline-flex items-center bg-white text-base font-medium hover:text-gray-900 focus:outline-none']">
      <span class="text-xs uppercase font-semibold">
        {{ label }}
      </span>

      <ChevronDownIcon
        class="h-5 w-5 text-gray-800 ml-1"
        :class="[open ? 'rotate-180' : 'rotate-0']"
        aria-hidden="true"
      />
    </PopoverButton>

    <transition enter-active-class="transition ease-out duration-200" enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0" leave-active-class="transition ease-in duration-150" leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
      <PopoverPanel class="absolute inset-x-0 z-10 bg-white shadow-md" :class="['top-' + topOffset]">
        <div class="overflow-hidden drop-shadow-2xl ring-1 ring-black ring-opacity-5 p-4">
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
    topOffset: { type: Number, required: true }
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