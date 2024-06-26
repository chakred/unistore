import './bootstrap';
import '../css/app.css';
import '../scss/app.scss';
import * as bootstrap from 'bootstrap';

import { createApp, h } from 'vue';
import { createStore } from 'vuex';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import 'vue3-easy-data-table/dist/style.css';

// import { Mark } from './Components/Stores/Mark'

const store = createStore({
    modules: {
 
    }
  })

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(store)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
