<template>
  <div
    v-if="editor"
    class="editor-container">
    <div v-if="options.enableFormatting" class="editor-menu bard-fixed-toolbar p-1">

      <button class="bard-toolbar-button has-tooltip"
        @click.prevent="editor.chain().focus().toggleBold().run()"
        :class="{ 'active': editor.isActive('bold') }"
        title="Bold">
        <i class="fa fa-bold icon-text-large"></i>
      </button>

      <button class="bard-toolbar-button has-tooltip"
        @click.prevent="editor.chain().focus().toggleItalic().run()"
        :class="{ 'active': editor.isActive('italic') }"
        title="Italic">
        <i class="fa fa-italic icon-text-large"></i>
      </button>

      <button class="bard-toolbar-button has-tooltip"
        @click.prevent="editor.chain().focus().toggleUnderline().run()"
        :class="{ 'active': editor.isActive('underline') }"
        title="Underline">
        <i class="fa fa-underline icon-text-large"></i>
      </button>

      <!-- <button class="bard-toolbar-button has-tooltip"
        @click.prevent="editor.chain().focus().toggleSubscript().run()"
        :class="{ 'active': editor.isActive('subscript') }"
        title="Subscript">
        <i class="fa fa-subscript icon-text-large"></i>
      </button> -->

      <button class="bard-toolbar-button has-tooltip"
        @click.prevent="editor.chain().focus().toggleSuperscript().run()"
        :class="{ 'active': editor.isActive('superscript') }"
        title="Superscript">
        <i class="fa fa-superscript icon-text-large"></i>
      </button>
      
      <button class="bard-toolbar-button has-tooltip"
        @click.prevent="setLink"
        :class="{ 'active': editor.isActive('link') }"
        title="Link">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4"><path fill="currentColor" d="M314.222 197.78c51.091 51.091 54.377 132.287 9.75 187.16-6.242 7.73-2.784 3.865-84.94 86.02-54.696 54.696-143.266 54.745-197.99 0-54.711-54.69-54.734-143.255 0-197.99 32.773-32.773 51.835-51.899 63.409-63.457 7.463-7.452 20.331-2.354 20.486 8.192a173.31 173.31 0 0 0 4.746 37.828c.966 4.029-.272 8.269-3.202 11.198L80.632 312.57c-32.755 32.775-32.887 85.892 0 118.8 32.775 32.755 85.892 32.887 118.8 0l75.19-75.2c32.718-32.725 32.777-86.013 0-118.79a83.722 83.722 0 0 0-22.814-16.229c-4.623-2.233-7.182-7.25-6.561-12.346 1.356-11.122 6.296-21.885 14.815-30.405l4.375-4.375c3.625-3.626 9.177-4.594 13.76-2.294 12.999 6.524 25.187 15.211 36.025 26.049zM470.958 41.04c-54.724-54.745-143.294-54.696-197.99 0-82.156 82.156-78.698 78.29-84.94 86.02-44.627 54.873-41.341 136.069 9.75 187.16 10.838 10.838 23.026 19.525 36.025 26.049 4.582 2.3 10.134 1.331 13.76-2.294l4.375-4.375c8.52-8.519 13.459-19.283 14.815-30.405.621-5.096-1.938-10.113-6.561-12.346a83.706 83.706 0 0 1-22.814-16.229c-32.777-32.777-32.718-86.065 0-118.79l75.19-75.2c32.908-32.887 86.025-32.755 118.8 0 32.887 32.908 32.755 86.025 0 118.8l-45.848 45.84c-2.93 2.929-4.168 7.169-3.202 11.198a173.31 173.31 0 0 1 4.746 37.828c.155 10.546 13.023 15.644 20.486 8.192 11.574-11.558 30.636-30.684 63.409-63.457 54.733-54.735 54.71-143.3-.001-197.991z" class=""></path></svg>
      </button>

      <button class="bard-toolbar-button has-tooltip"
        v-if="editor.isActive('link')"
        @click.prevent="editor.chain().focus().unsetLink().run()"
        title="Remove Link">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4"><path fill="currentColor" d="M304.083 388.936c4.686 4.686 4.686 12.284 0 16.971l-65.057 65.056c-54.709 54.711-143.27 54.721-197.989 0-54.713-54.713-54.719-143.27 0-197.989l65.056-65.057c4.686-4.686 12.284-4.686 16.971 0l22.627 22.627c4.686 4.686 4.686 12.284 0 16.971L81.386 311.82c-34.341 34.341-33.451 88.269.597 120.866 32.577 31.187 84.788 31.337 117.445-1.32l65.057-65.056c4.686-4.686 12.284-4.686 16.971 0l22.627 22.626zm-56.568-243.245l64.304-64.304c34.346-34.346 88.286-33.453 120.882.612 31.18 32.586 31.309 84.785-1.335 117.43l-65.056 65.057c-4.686 4.686-4.686 12.284 0 16.971l22.627 22.627c4.686 4.686 12.284 4.686 16.971 0l65.056-65.057c54.711-54.709 54.721-143.271 0-197.99-54.71-54.711-143.27-54.72-197.989 0l-65.057 65.057c-4.686 4.686-4.686 12.284 0 16.971l22.627 22.627c4.685 4.685 12.283 4.685 16.97-.001zm238.343 362.794l22.627-22.627c4.686-4.686 4.686-12.284 0-16.971L43.112 3.515c-4.686-4.686-12.284-4.686-16.971 0L3.515 26.142c-4.686 4.686-4.686 12.284 0 16.971l465.373 465.373c4.686 4.686 12.284 4.686 16.97-.001z" class=""></path></svg>
      </button>

      <button class="bard-toolbar-button has-tooltip"
        @click.prevent="editor.chain().focus().unsetAllMarks().run()"
        title="Clear formatting">
        <i class="fa fa-eraser icon-text-large"></i>
      </button>

    </div>

    <editor-content
      class="prose editor-content"
      :editor="editor">
    </editor-content>

    <div class="px-2 py-1.5 bg-grey-20 border-t flex items-center justify-end text-sm">
        <button class="text-grey hover:text-grey-90" @click.prevent="$emit('on-cancel')">Cancel</button>
        <button class="btn btn-primary ml-2" :class="buttonClass" @click.prevent="onSave">Save</button>
    </div>

  </div>
</template>

<script>
  import { Editor, EditorContent } from '@tiptap/vue-2'
  import StarterKit from '@tiptap/starter-kit'
  import Underline from '@tiptap/extension-underline'
  import Subscript from '@tiptap/extension-subscript'
  import Superscript from '@tiptap/extension-superscript'
  import Link from '@tiptap/extension-link'

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
        enableLinks: true,
        enableErase: true,
        ...this.menuOptions
      }

      this.editor = new Editor({
        extensions: [
          StarterKit,
          Underline,
          Subscript,
          Superscript,
          Link.configure({ openOnClick: false }),
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
  .bard-fixed-toolbar {
    top: 0;
    justify-content: flex-start;
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
    
    padding: 12px 16px !important;

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

    a {
      color: #1d8fc9;
      text-decoration: underline;
      cursor: text;
    }
  }
</style>