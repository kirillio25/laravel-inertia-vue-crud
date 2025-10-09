import './bootstrap';
import "bootstrap/dist/css/bootstrap.min.css";
import { createApp, h } from 'vue'
import { createInertiaApp, Head, Link } from '@inertiajs/vue3'
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Layout from "./Layouts/Layout.vue";



createInertiaApp({
    title: (title) => `My App ${title}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        let page = pages[`./Pages/${name}.vue`];
        page.default.layout = page.default.layout || Layout;
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('Head', Head) // Чтобы не импортировать
            .component('Link', Link) // Чтобы не импортировать
            .mount(el)
    },
    // Брогресс бар, индикатор
    progress: {
        color: '#29d',
        includeCSS: true,
        showSpinner: false,
    },
})
