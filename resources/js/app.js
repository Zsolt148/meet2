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

InertiaProgress.init({delay: 0, color: '#2dd4bf' });

// Images
require('../images/main-swimmer.png')
require('../images/waves1.svg')
require('../images/waves2.svg')