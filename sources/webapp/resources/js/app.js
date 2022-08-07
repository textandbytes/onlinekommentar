require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head, usePage } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Layout from './Shared/Layout.vue';
import NavLink from './Shared/NavLink.vue';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
const initialPage = JSON.parse(app.dataset.page);

import mitt from 'mitt'
const emitter = mitt()

createInertiaApp({
    title: (title) => `${appName} - ${title}`,
    resolve: async name => {
        let page = (await import(`./Pages/${name}.vue`)).default;
        if (!initialPage.props.is_cms && !name.startsWith('Dashboard') && !name.startsWith('DocumentTree')) {
            page.layout ??= Layout; // set the default layout if a layout is not defined
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
