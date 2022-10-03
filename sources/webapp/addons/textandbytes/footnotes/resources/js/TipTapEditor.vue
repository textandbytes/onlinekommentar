<template>
  <div
    v-if="editor"
    class="flex flex-col border border-gray-300 rounded-t-md rounded-b-none shadow-sm focus-within:border-indigo-300 focus-within:ring focus-within:ring-indigo-200 focus-within:ring-opacity-50 overflow-hidden">
    <div class="flex p-3 gap-4 border-b">
      <div v-if="options.enableFormatting" class="flex gap-1">
        <button
          @click.prevent="editor.chain().focus().toggleBold().run()"
          :class="{ 'is-active': editor.isActive('bold') }"
          title="[TRANSLATE TipTapEditor.bold]">
          <i class="ph-text-bolder text-lg"></i>
        </button>

        <button
          @click.prevent="editor.chain().focus().toggleItalic().run()"
          :class="{ 'is-active': editor.isActive('italic') }"
          title="[TRANSLATE TipTapEditor.italic]">
          <i class="ph-text-italic text-lg"></i>
        </button>

        <button
          @click.prevent="editor.chain().focus().toggleUnderline().run()"
          :class="{ 'is-active': editor.isActive('underline') }"
          title="[TRANSLATE TipTapEditor.underline]">
          <i class="ph-text-underline text-lg"></i>
        </button>

        <button
          @click.prevent="editor.chain().focus().toggleSubscript().run()"
          :class="{ 'is-active': editor.isActive('subscript') }"
          title="[TRANSLATE TipTapEditor.subscript]">
          <span class="font-normal px-0.5">x<sub>2</sub></span>
        </button>

        <button
          @click.prevent="editor.chain().focus().toggleSuperscript().run()"
          :class="{ 'is-active': editor.isActive('superscript') }"
          title="[TRANSLATE TipTapEditor.superscript]">
          <span class="font-normal px-0.5">x<sup>2</sup></span>
        </button>
      </div>
      
      <div v-if="options.enableLinks" class="flex gap-1">
        <button
          @click.prevent="setLink"
          :class="{ 'is-active': editor.isActive('link') }"
          title="[TRANSLATE TipTapEditor.link]">
          <i class="ph-link text-lg"></i>
        </button>

        <button
          @click.prevent="editor.chain().focus().unsetLink().run()"
          title="[TRANSLATE TipTapEditor.unset_link]">
          <i class="ph-link-break text-lg"></i>
        </button>
      </div>

      <div v-if="options.enableErase" class="flex gap-1">
        <button
          @click.prevent="editor.chain().focus().unsetAllMarks().run()"
          title="[TRANSLATE TipTapEditor.clear]">
          <i class="ph-eraser text-lg"></i>
        </button>
      </div>
    </div>

    <editor-content
      class="prose max-w-full p-3 overflow-scroll max-h-96"
      :editor="editor">
    </editor-content>
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
          Link.configure({
            openOnClick: false
          })
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