<template>
  <Listbox as="div" v-if="options.length > 0" v-model="selected" v-slot="{ open }" @update:modelValue="onSelect">
    <div class="relative">
      <ListboxButton
        class="w-full min-w-full shadow-sm text-xs px-2 py-1 cursor-pointer focus:outline-none"
        :class="{ 'bg-white rounded-t-sm': open }">
        <div
          class="flex items-center space-x-2"
          :class="{ 'border-b border-black': !open }">
          <span class="uppercase">
            {{ selected }}
          </span>

          <ChevronDownIcon
            class="h-5 w-5 text-gray-400"
            :class="[open ? 'rotate-180' : 'rotate-0']"
            aria-hidden="true"
          />
        </div>
      </ListboxButton>

      <transition
        v-show="open"
        enter-active-class="transition duration-100 ease-out"
        enter-from-class="transform scale-95 opacity-0"
        enter-to-class="transform scale-100 opacity-100"
        leave-active-class="transition ease-in duration-100"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0">
        <ListboxOptions class="absolute w-full bg-white shadow-lg max-h-60 rounded-b-sm text-xs overflow-auto focus:outline-none z-10">
          <ListboxOption as="template" v-for="option in options" :key="option.id" :value="option" v-slot="{ active, selected }">
            <li :class="[{ 'bg-ok-beige': active }, 'cursor-pointer select-none relative px-2 py-1']">
              <span
                class="uppercase"
                :class="[selected ? 'font-semibold' : 'font-normal', 'block']">
                {{ option }}
              </span>
            </li>
          </ListboxOption>
        </ListboxOptions>
      </transition>
    </div>
  </Listbox>
</template>

<script setup>
  import { ref } from 'vue'
  import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from '@headlessui/vue'
  import { ChevronDownIcon } from '@heroicons/vue/solid'

  const emit = defineEmits(['changed'])

  const props = defineProps({
    options: { type: Array, required: false, default: [] }
  })

  const selected = ref(props.options[0])

  const onSelect = (selection) => {
    emit('changed', selection);
  }
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

  ul > li + li {
    border-top: 1px solid #bbb;
  }
</style>