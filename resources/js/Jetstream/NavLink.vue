<template>
    <Link :href="href" :class="classes">
        <slot></slot>
    </Link>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    props: ['href', 'active'],
    components: {
        Link
    },

    computed: {
        classes() {
            return this.active
                        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-white dark:border-white font-bold leading-5 text-white dark:text-white focus:outline-none focus:border-black dark:focus:border-blue-600 transition tracking-wider'
                        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent font-bold leading-5 text-gray-200 dark:text-light-blue hover:text-white dark:hover:text-white hover:border-white dark:hover:border-white focus:outline-none focus:border-white dark:focus-border-white transition tracking-wider'
        }
    }
}
</script>
