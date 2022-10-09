import Footnote from './Footnote.js'
import FootnoteEditor from './FootnoteEditor.vue'

Statamic.$bard.extend(({ node }) => node(new Footnote()))

Statamic.$bard.buttons(() => {
  return {
    name: 'footnote',
    text: 'Footnote',
    icon: 'note',
    component: FootnoteEditor
  }
})