require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp, Link, Head, usePage } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Layout from './Shared/Layout.vue';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';
const initialPage = JSON.parse(app.dataset.page);

createInertiaApp({
    title: (title) => `${appName} - ${title}`,
    resolve: async name => {
        let page = (await import(`./Pages/${name}.vue`)).default;
        if (!initialPage.props.is_cms) {
            page.layout ??= Layout; // set the default layout if a layout is not defined
        }
        return page;
    },
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .component("Head", Head)
            .component("Link", Link)
            .mixin({ methods: { route } })
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
