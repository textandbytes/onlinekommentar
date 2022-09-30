require('./bootstrap')

require('phosphor-icons')

import { createApp } from 'vue'
import { i18nVue } from 'laravel-vue-i18n'

import AppHeader from '@/components/Layouts/AppHeader.vue'
import AppFooter from '@/components/Layouts/AppFooter.vue'

createApp({
  components: {
    'app-header': AppHeader,
    'app-footer': AppFooter,
  }
}).use(i18nVue, { 
    resolve: (lang) => import(`../../lang/${lang}.json`) 
})
.mount('#app')