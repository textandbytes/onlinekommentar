import '../css/addon.css'
import Converter from './components/fieldtypes/Converter.vue'

Statamic.booting(() => {
    Statamic.component('converter-fieldtype', Converter)
})
