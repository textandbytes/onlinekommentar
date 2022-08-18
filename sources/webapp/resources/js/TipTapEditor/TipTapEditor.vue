<template>
  <div v-if="editor" class="min-w-0 flex-1">
    <transition
      v-if="options.enableFootnotes"
      name="ease-out-overlay">
      <div
        v-show="showFootnoteEditor"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-10"
        aria-hidden="true">
      </div>
    </transition>

    <label
      v-if="label"
      :for="id"
      class="block font-medium text-sm text-gray-700"
      :class="{ 'required': required }">
      {{ label }}
    </label>

    <div class="tiptap-editor mt-1" :class="{ 'pointer-events-none': showFootnoteEditor }">
      <div class="tiptap-editor-menu sticky">
        <div v-if="options.enableFormatting" class="flex gap-1">
          <button
            @click.prevent="editor.chain().focus().toggleBold().run()"
            :class="{ 'is-active': editor.isActive('bold') }"
            :title="__('bold')">
            <i class="ph-text-bolder text-lg"></i>
          </button>

          <button
            @click.prevent="editor.chain().focus().toggleItalic().run()"
            :class="{ 'is-active': editor.isActive('italic') }"
            :title="__('italic')">
            <i class="ph-text-italic text-lg"></i>
          </button>
        </div>
        
        <div v-if="options.enableBlocks" class="flex gap-1">
          <button
            @click.prevent="editor.chain().focus().setParagraph().run()"
            :class="{ 'is-active': editor.isActive('paragraph') }"
            :title="__('paragraph')">
            <i class="ph-text-t text-lg"></i>
          </button>

          <button
            @click.prevent="editor.chain().focus().toggleHeading({ level: 1 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }"
            :title="__('heading_1')">
            <i class="ph-text-h-one text-lg"></i>
          </button>

          <button
            @click.prevent="editor.chain().focus().toggleHeading({ level: 2 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }"
            :title="__('heading_2')">
            <i class="ph-text-h-two text-lg"></i>
          </button>

          <button
            @click.prevent="editor.chain().focus().toggleHeading({ level: 3 }).run()"
            :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }"
            :title="__('heading_3')">
            <i class="ph-text-h-three text-lg"></i>
          </button>
        </div>

        <div v-if="options.enableLists" class="flex gap-1">
          <button
            @click.prevent="editor.chain().focus().toggleBulletList().run()"
            :class="{ 'is-active': editor.isActive('bulletList') }"
            :title="__('bullet_list')">
            <i class="ph-list-bullets text-lg"></i>
          </button>

          <button
            @click.prevent="editor.chain().focus().toggleOrderedList().run()"
            :class="{ 'is-active': editor.isActive('orderedList') }"
            :title="__('ordered_list')">
            <i class="ph-list-numbers text-lg"></i>
          </button>
        </div>

        <div v-if="options.enableLinks" class="flex gap-1">
          <button
            @click.prevent="setLink"
            :class="{ 'is-active': editor.isActive('link') }"
            :title="__('link')">
            <i class="ph-link text-lg"></i>
          </button>

          <button
            @click.prevent="editor.chain().focus().unsetLink().run()"
            :title="__('unset_link')">
            <i class="ph-link-break text-lg"></i>
          </button>
        </div>

        <div v-if="options.enableFootnotes" class="flex gap-1">
          <button
            @click.prevent="editor.chain().focus().addFootnote().run()"
            :class="{ 'is-active': editor.isActive('footnote') }"
            :title="__('footnote')">
            <i class="ph-asterisk text-lg"></i>
          </button>
        </div>

        <div v-if="options.enableHistory" class="flex gap-1">
          <button
            @click.prevent="editor.chain().focus().undo().run()"
            :title="__('undo')">
            <i class="ph-arrow-counter-clockwise text-lg"></i>
          </button>

          <button
            @click.prevent="editor.chain().focus().redo().run()"
            :title="__('redo')">
            <i class="ph-arrow-clockwise text-lg"></i>
          </button>
        </div>

        <div v-if="options.enableErase" class="flex gap-1">
          <button
            @click.prevent="editor.chain().focus().unsetAllMarks().run()"
            :title="__('clear')">
            <i class="ph-eraser text-lg"></i>
          </button>
        </div>
      </div>

      <transition name="ease-out-bubble-menu">
        <bubble-menu
          v-if="options.enableFootnotes"
          :editor="editor"
          :tippy-options="{
            maxWidth: 600,
            offset: [100, 10],
            duration: [100, 200],
            zIndex: 10
          }"
          :should-show="shouldShowFootnoteEditor"
          class="bg-white">
          <TipTapEditor
            :key="footnoteEditorKey"
            v-model="footnoteContent"
            :menu-options="{
              enableBlocks: false,
              enableLists: false,
              enableLinks: false,
              enableFootnotes: false
            }"
            auto-focus="end"
            class="pointer-events-auto">
            <template v-slot:footer>
              <div class="tiptap-editor-footer">
                <button
                  type="button"
                  @click.prevent="saveFootnote"
                  :title="__('save_footnote')">
                  Save
                </button>

                <button
                  type="button"
                  @click.prevent="hideFootnoteEditor"
                  :title="__('cancel_footnote')"
                  class="ml-2">
                  Cancel
                </button>
              </div>
            </template>
          </TipTapEditor>
        </bubble-menu>
      </transition>

      <editor-content
        class="tiptap-editor-content prose overflow-scroll"
        :editor="editor">
      </editor-content>

      <slot name="footer"></slot>
    </div>

    <div
      v-if="error"
      class="block font-medium text-sm text-red-700 mt-2 ml-1">
      {{ error }}
    </div>
  </div>
</template>

<script>
  import { Editor, EditorContent, BubbleMenu } from '@tiptap/vue-3'
  import { isActive, getAttributes } from '@tiptap/core'
  import StarterKit from '@tiptap/starter-kit'
  import Link from '@tiptap/extension-link'
  import Footnote from './extensions/footnote'
  import { v4 as uuid } from 'uuid'

  export default {
    name: 'TapTapEditor',

    components: {
      EditorContent,
      BubbleMenu
    },

    props: {
      id: { type: String, default() { return `html-editor-${uuid()}` } },
      modelValue: { type: String, required: false, default: '' },
      error: String,
      required: Boolean,
      label: String,
      menuOptions: { type: Object, required: false, default: () => {} },
      autoFocus: { type: [String, Number, Boolean], required: false, default: false }
    },

    emits: ['update:modelValue'],

    data() {
      return {
        editor: null,
        options: null,
        footnoteContent: '',
        footnoteEditorKey: uuid(),
        showFootnoteEditor: false
      }
    },

    mounted() {
      // initialize menu options
      this.options = {
        enableFormatting: true,
        enableBlocks: true,
        enableLists: true,
        enableLinks: true,
        enableFootnotes: true,
        enableHistory: true,
        enableErase: true,
        ...this.menuOptions
      }

      this.editor = new Editor({
        extensions: [
          StarterKit,
          Link.configure({
            openOnClick: false
          }),
          Footnote
        ],

        autofocus: this.autoFocus,

        content: this.modelValue,

        onUpdate: () => {
          // update the value when the content changes
          this.$emit('update:modelValue', this.editor.getHTML())
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
        }

        // update link
        this.editor.chain().focus().extendMarkRange(markName).setLink({ href: linkRef }).updateAttributes(markName).run()
      },

      setLink() {
        const url = window.prompt('URL', this.editor.getAttributes('link').href)
        this.updateEditorContentWithLink('link', url)
      },

      shouldShowFootnoteEditor({ state }) {
        const showBubbleMenu = isActive(state, 'footnote')

        if (showBubbleMenu) {
          // set the footnote content in the editor before displaying the bubble menu
          this.footnoteContent = getAttributes(state, 'footnote')['data-content']

          // force re-render the footnote editor by updating its unique key in order to focus the cursor in the editor after adding a footnote
          this.footnoteEditorKey = uuid()
        }

        this.showFootnoteEditor = showBubbleMenu

        return showBubbleMenu
      },

      saveFootnote() {
        this.editor.chain().focus().updateFootnote({ 'data-content': this.footnoteContent }).run()
        this.hideFootnoteEditor()
      },

      hideFootnoteEditor() {
        this.editor.chain().focus().deselectFootnote().run()
        this.showFootnoteEditor = false
      }
    },

    beforeUnmount() {
      this.editor.destroy()
    }
  }
</script>

<style lang="postcss" scoped>
  .required:after {
    content: " *";
    color: red;
  }

  .tiptap-editor {
    @apply flex flex-col border border-gray-300 rounded-md shadow-sm focus-within:border-indigo-300 focus-within:ring focus-within:ring-indigo-200 focus-within:ring-opacity-50 overflow-hidden;

    .tiptap-editor-menu {
      @apply flex px-3 py-2 gap-4 border-b;
    }

    .tiptap-editor-content {
      @apply max-w-full px-3;
      max-height: 600px;
    }

    .tiptap-editor-footer {
      @apply flex justify-end border-t border-gray-300 p-3;
    }

    button {
      @apply inline-flex items-center px-1 py-1 border border-transparent shadow-sm text-sm leading-4 font-medium rounded-md bg-gray-200 hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300;

      &.is-active {
        @apply text-white bg-green-600 hover:bg-green-700 focus:ring-green-500;
      }
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

    /*
     * Links
     */
    
    a {
      font-weight: 400;
    }

    /*
     * Footnotes
     */

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

  /*
   * Set the width of the bubble menu.
   */

  [data-tippy-root] {
    width: 40%;
  }

  .ease-out-overlay-enter-active, .ease-out-overlay-leave-active {
    @apply opacity-100 duration-300;
  }

  .ease-out-overlay-enter, .ease-out-overlay-leave-to /* .fade-leave-active below version 2.1.8 */ {
    @apply ease-in opacity-0 duration-200;
  }

  .ease-out-bubble-menu-enter-active, .ease-out-bubble-menu-leave-active {
    @apply opacity-100 translate-y-0 sm:scale-100 duration-300;
  }

  .ease-out-bubble-menu-enter, .ease-out-bubble-menu-leave-to /* .fade-leave-active below version 2.1.8 */ {
    @apply ease-in opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95 duration-200;
  }
</style>