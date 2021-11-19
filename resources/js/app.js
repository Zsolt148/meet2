require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import {createInertiaApp, Link, Head } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

createInertiaApp({
    title: (title) => `${title} - meet.kvsc.info`,
    resolve: (name) => require(`./Pages/${name}.vue`),

    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .component('Link', Link)
            .component('Head', Head)
            .mixin(require('./Use/baseMixin'))
            .mount(el);
    },
});

InertiaProgress.init({delay: 100, color: '#008F93' });

//Images
require('../images/main-swimmer.png')
require('../images/waves11.svg')
require('../images/waves22.svg')