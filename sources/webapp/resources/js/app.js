require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head, usePage } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import CmsLayout from '@/Layouts/CmsLayout.vue';
import Layout from './Shared/Layout.vue';
import NavLink from './Shared/NavLink.vue';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
const initialPage = JSON.parse(app.dataset.page);

import mitt from 'mitt'
const emitter = mitt()

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async name => {
        let page = (await import(`./Pages/${name}.vue`)).default;

        // set the 'layout' property to null in page components to override any layout from being used 
        if (page.layout === undefined) {
            page.layout = initialPage.props.is_cms ? CmsLayout : Layout
        }

        return page;
    },
    setup({ el, app: inertiaApp, props, plugin }) {
        const app = createApp({ render: () => h(inertiaApp, props) })
            .use(plugin)
            .component("Head", Head)
            .component("Link", Link)
            .component("NavLink", NavLink)
            .mixin({ methods: { route } })
        app.config.globalProperties.emitter = emitter
        app.mount(el)
    },
});

InertiaProgress.init({ color: '#4B5563' });
