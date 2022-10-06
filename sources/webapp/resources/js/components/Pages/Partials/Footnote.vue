<template>
  <VDropdown>
    <span class="footnote-number"></span>
    <template #popper>
      <div class="footnote-content" v-html="dataContent"></div>
    </template>
  </VDropdown>
</template>

<script>
  export default {
    name: 'Footnote',

    props: {
      dataContent: { type: String, required: false, default: null },
    }
  }
</script>

<style lang="postcss">
  .footnote-number {
    @apply 
      inline-block
      border
      border-black
      hover:bg-black
      hover:text-white
      rounded-full
      font-sans
      text-center
      ml-1;
      width: 16px;
      height: 16px;
      line-height: 15px;
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
    
    div:first-child {
      @apply grid grid-cols-1;
    }

    .footnote-content {
      @apply bg-ok-orange;

    }
  }
</style>