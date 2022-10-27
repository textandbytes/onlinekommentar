<template>
  <VDropdown>
    <span class="footnote-number"></span>
    <template #popper>
      <div class="footnote-content" v-html="dataContent"></div>
    </template>
  </VDropdown>
</template>

<script>

  import { store } from '@/composables/store.js'

  export default {
    name: 'Footnote',

    props: {
      dataContent: { type: String, required: false, default: null },
    },

    mounted() {
        store.footnotes.push(this.dataContent)
    },
  }
</script>

<style lang="postcss">
  .footnote-number {
    @apply
      relative
      inline-flex
      justify-center
      items-center
      border
      border-black
      hover:bg-black
      hover:text-white
      rounded-full
      text-[12px]
      font-sans
      ml-1
      pb-[1px]
      xl:pb-[2px]
      2xl:pb-0;
      min-width: 18px;
      height: 18px;
  }

  .v-popper__arrow-container {
    display: none;
  }

  .v-popper.v-popper--theme-dropdown {
    @apply inline;
  }

  .v-popper__popper.v-popper--theme-dropdown {
    @apply max-w-3xl outline-none;
  }

  .v-popper__inner {
    @apply p-4 bg-ok-orange text-black border-0 text-sm !important;

    .footnote-content {
      @apply bg-ok-orange;

    }
  }

  del {
    @apply bg-[#e77276]
  }
  
  ins {
    @apply bg-[#79ee75]
  }
</style>
