import { Node, mergeAttributes } from '@tiptap/core';

export default Node.create({
  name: 'footnote',

  // add to 'inline' group
  group: 'inline',

  // render nodes in line with the text
  inline: true,

  // must not have anything else than 'text'
  content: 'text*',

  // treat as a single unit that is not directly editable
  atom: true,

  addAttributes() {
    return {
      'data-content': {
        default: null
      }
    }
  },

  renderHTML({ HTMLAttributes }) {
    return ['footnote', mergeAttributes(this.options.HTMLAttributes, HTMLAttributes)];
  },

  parseHTML() {
    return [{
      tag: 'footnote'
    }]
  },

  addCommands() {
    return {
      addFootnote: () => ({ chain, commands }) => {
        return chain()
          .insertContent({ type: 'footnote' })
          .command(({ tr }) => {
            // place the cursor on the newly added footnote to open the bubble menu
            commands.setTextSelection(tr.selection.anchor - 1);
          })
          .run();
      },

      updateFootnote: (attributes) => ({ commands }) => {
        return commands.updateAttributes('footnote', attributes);
      },

      deselectFootnote: () => ({ chain, commands }) => {
        return chain()
          .command(({ tr }) => {
            // place the cursor directly after the footnote so it is no longer the active element
            commands.setTextSelection(tr.selection.anchor + 1);
            // set the focus to the position directly after the footnote to close the bubble menu
            commands.focus(tr.selection.anchor + 1);
          })
          .run();
      }
    }
  }
});