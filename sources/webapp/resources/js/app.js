require('./bootstrap')

require('phosphor-icons')

import { createApp, h } from 'vue'
import { createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import NavLink from './Shared/NavLink.vue'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Onlinekommentar'

import mitt from 'mitt'
const emitter = mitt()

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async name => {
        let page = (await import(`./Pages/${name}.vue`)).default

        /*
         * Set the default layout if the 'layout' property is not defined
         * in a page component.
         * 
         * Note: Setting the 'layout' property explicitly to null in a page 
         *       component will override any layout from being used.
         * 
         */
        if (page.layout === undefined) {
            page.layout ??= GuestLayout
        }

        return page
    },
    setup({ el, app: inertiaApp, props, plugin }) {
        const app = createApp({ render: () => h(inertiaApp, props) })
            .use(plugin)
            .component('Head', Head)
            .component('Link', Link)
            .component('NavLink', NavLink)
            .mixin({ methods: { route } })
            .mixin(require('./base'))
        app.config.globalProperties.emitter = emitter
        app.mount(el)
    },
});

InertiaProgress.init({ color: '#4B5563' })
