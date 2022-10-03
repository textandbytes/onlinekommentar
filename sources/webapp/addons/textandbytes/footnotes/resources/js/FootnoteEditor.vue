<template>
  <div class="footnote-wrapper">
    <button
      class="bard-toolbar-button"
      :class="{ 'active': show }"
      v-html="button.html"
      v-tooltip="button.text"
      @click="show = !show">
    </button>

    <ModalOverlayWithFooter
      v-if="show"
      class="footnote-container">
      <template v-slot:body>
        <TipTapEditor />
      </template>
    </ModalOverlayWithFooter>
  </div>
</template>

<script>
  import ModalOverlayWithFooter from './ModalOverlayWithFooter.vue'
  import TipTapEditor from './TipTapEditor.vue'

  export default {
    mixins: [BardToolbarButton],

    components: {
      ModalOverlayWithFooter,
      TipTapEditor
    },

    data() {
      return {
        show: false
      }
    }
  }
</script>

<style lang="postcss">
  .footnote-wrapper {
    @apply inline-block relative;
  }

  .footnote-container {
    @apply absolute bg-white border border-gray-300 rounded-sm z-10 divide-y divide-gray-100 shadow-lg;
  }
</style>