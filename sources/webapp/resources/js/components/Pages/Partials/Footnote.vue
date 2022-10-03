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
  .v-popper.v-popper--theme-dropdown {
    @apply inline;
  }

  .v-popper__popper.v-popper--theme-dropdown {
    @apply max-w-3xl outline-none;
  }

  .v-popper__inner {
    @apply p-4 bg-white text-black border-0 text-sm;
    
    div:first-child {
      @apply grid grid-cols-1;
    }

    .footnote-number {
      @apply row-start-1 row-end-2 col-start-1 col-end-1;
    }

    .footnote-content {
      @apply row-start-1 row-end-2 col-start-1 col-end-1;

      p:first-of-type {
        text-indent: 2rem;
      }
    }
  }
</style>