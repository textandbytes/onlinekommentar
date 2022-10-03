import Footnote from './Footnote.js'
import FootnoteEditor from './FootnoteEditor.vue'

require('phosphor-icons')

Statamic.$bard.extend(({ node }) => node(new Footnote()))

Statamic.$bard.buttons(() => {
  return {
    name: 'footnote',
    text: 'Footnote',
    icon: 'asterisk',
    component: FootnoteEditor
  }
})