<template>
  <div>
    <button
      class="bard-toolbar-button"
      :class="{ 'active': isButtonActive }"
      v-html="button.html"
      v-tooltip="button.text"
      @click="isButtonActive = !isButtonActive">
    </button>

    <modal
      v-if="isButtonActive || isFootnoteActive"
      name="footnote-modal"
      width="500px"
      pivot-y="0.5"
      @closed="hideEditor"
    >
      <TipTapEditor
        v-model="content"
        @on-save="onSave"
        @on-cancel="onCancel"
      />
    </modal>
  </div>
</template>

<script>
  import TipTapEditor from './TipTapEditor.vue'

  export default {
    mixins: [BardToolbarButton],

    components: {
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
  .ProseMirror {
    counter-reset: footnote-counter;

    footnote {
      cursor: pointer;
    }
  
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