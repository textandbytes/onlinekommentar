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
    return {}
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