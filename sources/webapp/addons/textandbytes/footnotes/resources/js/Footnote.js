const { Node } = Statamic.$bard.tiptap.core;

const Footnote = Node.create({

  name: 'footnote',
      
  group: 'inline',

  inline: true,

  addAttributes() {
    return {
      'data-content': {
        default: null,
      },
    }
  },

  parseHTML() {
    return [
      { tag: 'footnote' },
    ]
  },

  renderHTML({ HTMLAttributes }) {
    return ['footnote', HTMLAttributes];
  },

  addCommands() {
    return {
      addFootnote: (attrs) => ({ chain }) => {
        return chain().focus().insertContent({ type: this.name, attrs }).run();
      },

      updateFootnote: (attrs) => ({ chain }) => {
        return chain().focus().updateAttributes(this.type, attrs).run();
      },

      deselectFootnote: () => ({ chain, state }) => {
        return chain().focus().setTextSelection(state.selection.from).run();
      }
    }
  },

});
export default Footnote;