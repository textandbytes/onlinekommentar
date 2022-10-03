<template>
  <div class="footnote-wrapper">
    <button
      class="bard-toolbar-button"
      :class="{ 'active': showEditor }"
      v-html="button.html"
      v-tooltip="button.text"
      @click="showEditor = !showEditor">
    </button>

    <div
      v-if="showEditor"
      class="footnote-container">
      <div>
        [Show Footnote Editor]
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    mixins: [BardToolbarButton],

    data() {
      return {
        showEditor: false
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