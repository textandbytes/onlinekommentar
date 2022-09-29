require('./bootstrap')

require('phosphor-icons')

import { createApp } from 'vue'

import AppHeader from '@/components/Layouts/AppHeader.vue'
import AppFooter from '@/components/Layouts/AppFooter.vue'

createApp({
  components: {
    'app-header': AppHeader,
    'app-footer': AppFooter,
  }
}).mount('#app')