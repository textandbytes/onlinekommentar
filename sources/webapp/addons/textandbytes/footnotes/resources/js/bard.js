import Footnote from './Footnote.js'
import FootnoteEditor from './FootnoteEditor.vue'

Statamic.$bard.addExtension(() => Footnote)

Statamic.$bard.buttons(() => {
  return {
    name: 'footnote',
    text: 'Footnote',
    html: '<span class="footnotes-icon">Fn</span>',
    component: FootnoteEditor
  }
})