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
          tag: 'footnote[data-content]',
          getAttrs: dom => ({
            'data-content': dom.getAttribute('data-content'),
          }),
        },
      ],

      toDOM: node => ['footnote', node.attrs],
    }
  }
  
  commands({ type }) {
    return {
      addFootnote: (attrs) => (state, dispatch) => {
        const { selection } = state
        const position = selection.$cursor ? selection.$cursor.pos : selection.$to.pos
        const node = type.create(attrs)
        const transaction = state.tr.insert(position, node)
        dispatch(transaction)
      },

      updateFootnote: (attrs) => (state, dispatch) => {},

      deselectFootnote: () => (state, dispatch) => {}
    }
  }
  
  inputRules({ type }) {
    return [] // Input rules if you want
  }
  
  plugins() {
    return []
  }
  
  pasteRules() {
    return []
  }
}