<template>
  <div
    v-if="editor"
    class="editor-container">
    <div class="editor-menu">
      <div v-if="options.enableFormatting" class="editor-menu-group">
        <button class="bard-toolbar-button has-tooltip"
          @click.prevent="editor.chain().focus().toggleBold().run()"
          :class="{ 'is-active': editor.isActive('bold') }"
          title="Bold">
          <i class="fa fa-bold icon-text-large"></i>
        </button>

        <button class="bard-toolbar-button has-tooltip"
          @click.prevent="editor.chain().focus().toggleItalic().run()"
          :class="{ 'is-active': editor.isActive('italic') }"
          title="Italic">
          <i class="fa fa-italic icon-text-large"></i>
        </button>

        <button class="bard-toolbar-button has-tooltip"
          @click.prevent="editor.chain().focus().toggleUnderline().run()"
          :class="{ 'is-active': editor.isActive('underline') }"
          title="Underline">
          <i class="fa fa-underline icon-text-large"></i>
        </button>

        <!-- <button class="bard-toolbar-button has-tooltip"
          @click.prevent="editor.chain().focus().toggleSubscript().run()"
          :class="{ 'is-active': editor.isActive('subscript') }"
          title="Subscript">
          <i class="fa fa-subscript icon-text-large"></i>
        </button> -->

        <button class="bard-toolbar-button has-tooltip"
          @click.prevent="editor.chain().focus().toggleSuperscript().run()"
          :class="{ 'is-active': editor.isActive('superscript') }"
          title="Superscript">
          <i class="fa fa-superscript icon-text-large"></i>
        </button>
      </div>
      
      <div v-if="options.enableLinks" class="editor-menu-group">
        <button class="bard-toolbar-button has-tooltip"
          @click.prevent="setLink"
          :class="{ 'is-active': editor.isActive('link') }"
          title="Link">
          <i class="fa fa-link icon-text-large"></i>
        </button>

        <button class="bard-toolbar-button has-tooltip"
          @click.prevent="editor.chain().focus().unsetLink().run()"
          title="Remove Link">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M17 17h5v2h-3v3h-2v-5zM7 7H2V5h3V2h2v5zm11.364 8.536L16.95 14.12l1.414-1.414a5 5 0 1 0-7.071-7.071L9.879 7.05 8.464 5.636 9.88 4.222a7 7 0 0 1 9.9 9.9l-1.415 1.414zm-2.828 2.828l-1.415 1.414a7 7 0 0 1-9.9-9.9l1.415-1.414L7.05 9.88l-1.414 1.414a5 5 0 1 0 7.071 7.071l1.414-1.414 1.415 1.414zm-.708-10.607l1.415 1.415-7.071 7.07-1.415-1.414 7.071-7.07z"/></svg>
        </button>
      </div>

      <div v-if="options.enableErase" class="editor-menu-group">
        <button class="bard-toolbar-button has-tooltip"
          @click.prevent="editor.chain().focus().unsetAllMarks().run()"
          title="Clear formatting">
          <i class="fa fa-eraser icon-text-large"></i>
        </button>
      </div>
    </div>

    <editor-content
      class="prose editor-content"
      :editor="editor">
    </editor-content>

    <div class="editor-footer">
      <button
        class="save-button"
        type="button"
        title="Save Footnote"
        @click.prevent="onSave">
        Save
      </button>

      <button
        class="cancel-button"
        type="button"
        title="Cancel"
        @click.prevent="$emit('on-cancel')">
        Cancel
      </button>
    </div>
  </div>
</template>

<script>
  import { Editor, EditorContent } from '@tiptap/vue-2'
  import StarterKit from '@tiptap/starter-kit'
  import Underline from '@tiptap/extension-underline'
  import Subscript from '@tiptap/extension-subscript'
  import Superscript from '@tiptap/extension-superscript'

  export default {
    name: 'TapTapEditor',

    components: {
      EditorContent
    },

    props: {
      value: { type: String, required: false, default: '' },
      menuOptions: { type: Object, required: false, default: () => {} },
      autoFocus: { type: String|Number|Boolean, required: false, default: false }
    },

    data() {
      return {
        editor: null,
        options: null,
        footnoteContent: ''
      }
    },

    watch: {
      value(value) {
        const isSame = this.editor.getHTML() === value

        if (isSame) {
          return
        }

        this.editor.commands.setContent(value, false)
      }
    },

    mounted() {
      // initialize menu options
      this.options = {
        enableFormatting: true,
        enableLinks: false,
        enableErase: true,
        ...this.menuOptions
      }

      this.editor = new Editor({
        extensions: [
          StarterKit,
          Underline,
          Subscript,
          Superscript
        ],

        autofocus: this.autoFocus,

        content: this.value,

        onUpdate: () => {
          // update the value when the content changes
          this.$emit('input', this.editor.getHTML())
        }
      })
    },

    methods: {
      onSave() {
        this.$emit('on-save', this.editor.getHTML())
      },

      updateEditorContentWithLink(markName, linkRef) {
        // cancelled
        if (linkRef === null) {
          return
        }

        // empty
        if (linkRef === '') {
          this.editor.chain().focus().extendMarkRange(markName).unsetLink().run()
          return
        }

        // update link
        this.editor.chain().focus().extendMarkRange(markName).setLink({ href: linkRef }).updateAttributes(markName).run()
      },

      setLink() {
        const url = window.prompt('URL', this.editor.getAttributes('link').href)
        this.updateEditorContentWithLink('link', url)
      }
    },

    beforeUnmount() {
      this.editor.destroy()
    }
  }
</script>

<style lang="postcss" scoped>
  .editor-container {
    @apply flex flex-col border border-gray-300 rounded-t-md rounded-b-none shadow-sm focus-within:border-indigo-300 focus-within:ring focus-within:ring-indigo-200 focus-within:ring-opacity-50 overflow-hidden;

    .editor-menu {
      @apply flex p-3 gap-4 border-b;

      .editor-menu-group {
        @apply flex gap-1;
      }
    }

    .editor-content {
      @apply max-w-full p-3 overflow-scroll max-h-96;
    }

    .editor-footer {
      @apply bg-white p-3 sm:flex sm:flex-row-reverse border-t border-gray-300;

      .save-button {
        @apply inline-flex w-full justify-center rounded-md border border-transparent bg-gray-200 p-2 text-base font-medium text-black shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 sm:ml-3 sm:w-auto sm:text-sm;
      }

      .cancel-button {
        @apply mt-3 inline-flex w-full justify-center rounded-md border border-gray-300 bg-gray-200 p-2 text-base font-medium text-black shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm;
      }
    }
  }

  i.icon-text-large {
    @apply text-lg;
  }

  .icon-script {
    @apply font-normal px-0.5;
  }

  button {
    @apply inline-flex items-center px-1 py-1 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md bg-gray-200 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300;

    &.is-active {
      @apply text-white bg-green-600 hover:bg-green-700 focus:ring-green-500;
    }
  }
</style>

<style lang="postcss">
  /*
   * Disable the outline focus styles on the ProseMirror input field since these
   * styles are applied to the parent element that encapsulates the input field
   * with a menu bar.
   */

  .ProseMirror-focused:focus {
    outline: none;
  }

  .ProseMirror {
    > * + * {
      margin-top: 0.75em;
    }

    p {
      margin: 0.5em 0;
    }

    ul, ol {
      padding: 0 1rem;
    }

    h1, h2, h3, h4, h5, h6 {
      line-height: 1.1;
    }

    code {
      background-color: rgba(#616161, 0.1);
      color: #616161;
    }

    pre {
      background: #0D0D0D;
      color: #FFF;
      font-family: 'JetBrainsMono', monospace;
      padding: 0.75rem 1rem;
      border-radius: 0.5rem;

      code {
        color: inherit;
        padding: 0;
        background: none;
        font-size: 0.8rem;
      }
    }

    img {
      max-width: 100%;
      height: auto;
    }

    blockquote {
      padding-left: 1rem;
      border-left: 2px solid rgba(#0D0D0D, 0.1);
    }

    hr {
      border: none;
      border-top: 2px solid rgba(#0D0D0D, 0.1);
      margin: 2rem 0;
    }
  }
</style>