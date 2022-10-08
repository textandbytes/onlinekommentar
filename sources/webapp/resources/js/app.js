require('./bootstrap')

import FloatingVue from 'floating-vue'
FloatingVue.options.themes.dropdown.placement = 'top'
FloatingVue.options.themes.dropdown.distance = 10

import { createApp } from 'vue'
import { i18nVue } from 'laravel-vue-i18n'

import AppHeader from '@/components/Layouts/AppHeader.vue'
import AppFooter from '@/components/Layouts/AppFooter.vue'
import Commentaries from '@/components/Pages/Commentaries.vue'
import Commentary from '@/components/Pages/Commentary.vue'
import Footnote from '@/components/Pages/Partials/Footnote.vue'
import Authors from '@/components/Pages/Authors.vue'
import Editors from '@/components/Pages/Editors.vue'

createApp({
  components: {
    'app-header': AppHeader,
    'app-footer': AppFooter,
    'commentaries': Commentaries,
    'commentary': Commentary,
    'footnote': Footnote,
    'authors': Authors,
    'editors': Editors,
  }
})
.use(FloatingVue)
.use(i18nVue, { 
  resolve: (lang) => import(`../../lang/${lang}.json`) 
})
.mount('#app')