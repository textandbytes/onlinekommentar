<template>
  <div class="footnote-wrapper">
    <button
      class="bard-toolbar-button"
      :class="{ 'active': isButtonActive }"
      v-html="button.html"
      v-tooltip="button.text"
      @click="isButtonActive = !isButtonActive">
    </button>

    <ModalOverlayWithFooter
      v-if="isButtonActive || isFootnoteActive"
      class="footnote-container">
      <template v-slot:body>
        <TipTapEditor
          v-model="content"
          @on-save="onSave"
          @on-cancel="onCancel"
        />
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
        isButtonActive: false,
        content: ''
      }
    },

    computed: {
      isFootnoteActive() {
        const active = this.editor.activeNodes.footnote()
        if (active) {
          this.content = this.editor.getNodeAttrs('footnote')['data-content']
        }
        return active
      }
    },

    methods: {
      onSave(content) {
        this.isFootnoteActive ? this.saveFootnote(content) : this.addFootnote(content)
        this.hideEditor()
      },

      onCancel() {
        this.hideEditor()
      },

      addFootnote(content) {
        // add the footnote node to the editor
        this.editor.commands.addFootnote({
          'data-content': content
        })
      },

      saveFootnote(content) {
        // update the footnote node in the editor
        this.editor.commands.updateFootnote({
          'data-content': content
        })
      },

      hideEditor() {
        // clear the content field
        this.content = ''

        // reset the active state of the button
        this.isButtonActive = false

        // deselect the active footnote to hide the editor
        if (this.isFootnoteActive) {
          this.editor.commands.deselectFootnote()
        }
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

  .ProseMirror {
    counter-reset: footnote-counter;
  
    footnote::after {
      content: counter(footnote-counter);
      counter-increment: footnote-counter;
      vertical-align: super;
      font-size: 75%;
      padding-left: 1px;
      padding-right: 0.5px;
    }

    footnote.ProseMirror-selectednode {
      outline: 2px solid #8cf;
    }
  }
</style>