require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin(require('./Use/base'))
    .use(InertiaPlugin)
    .mount(el);

InertiaProgress.init({delay: 200, color: '#4B5563' });

//Images
require('../images/main-swimmer.png')
require('../images/waves1.svg')
require('../images/waves11.svg')
require('../images/waves2.svg')
require('../images/waves22.svg')