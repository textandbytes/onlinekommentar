const { core: tiptap, commands, utils } = Statamic.$bard.tiptap

export default class Footnote {
  constructor(options = {}) {
    this.options = options
  }
  
  name() {
    return 'footnote'
  }
  
  schema() {
    return {
      // add to 'inline' group
      group: 'inline',

      // render nodes in line with the text
      inline: true,

      // attributes
      attrs: {
        'data-content': {
          default: null
        }
      },

      // must not have anything else than 'text'
      content: 'text*',

      // treat as a single unit that is not directly editable
      atom: true,

      parseDOM: [
        {
          tag: 'footnote',
          getAttrs: (dom) => ({
            'data-content': dom.getAttribute('data-content'),
          })
        }
      ],

      toDOM: node => ['footnote', node.attrs]
    }
  }
  
  commands({ type, toggleBlockType }) {
    return {
      addFootnote: (attrs) => (state, dispatch) => {
        const { selection } = state
        const position = selection.$cursor ? selection.$cursor.pos : selection.$to.pos
        const node = type.create(attrs)
        const transaction = state.tr.insert(position, node)
        dispatch(transaction)
      },

      updateFootnote: (attrs) => (state, dispatch) => {
        // replace the footnote node with new content
        const node = type.create(attrs)
        const transaction = state.tr.replaceSelectionWith(node)
        dispatch(transaction)

        return toggleBlockType(type)
      },

      deselectFootnote: () => (state, dispatch) => {
        // do not dispatch command if the selection is empty
        if (!state.selection.empty) {
          const endPosition = state.selection.$to.pos
          const selection = new tiptap.TextSelection(state.doc.resolve(endPosition))
          const transaction = state.tr.setSelection(selection)
          dispatch(transaction)
        }
      }
    }
  }
  
  inputRules({ type }) {
    return []
  }
  
  plugins() {
    return []
  }
  
  pasteRules() {
    return []
  }
}